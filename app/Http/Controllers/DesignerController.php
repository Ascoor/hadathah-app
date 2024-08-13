<?php

namespace App\Http\Controllers;

use App\Models\Designer;
use App\Helpers\ConversionHelper;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\MailinaboxService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Rules\PhoneNumber;
use App\Http\Controllers\Traits\HandlesImages;

class DesignerController extends Controller
{
    use HandlesImages;

    protected $mailinaboxService;

    public function __construct(MailinaboxService $mailinaboxService)
    {
        $this->mailinaboxService = $mailinaboxService;
    }

    public function index()
    {
        $designers = Designer::all();
        return response()->json($designers);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => ['required', 'string', 'max:255', new PhoneNumber], 
            'skills' => 'required|string|max:255',
        ]);

        $defaultPassword = 'defaultPassword123'; 
        $emailBase = 'hadathah-user';
        $emailDomain = '@hadathah.org';

        DB::beginTransaction();
        try {
            $latestUser = User::where('email', 'LIKE', "$emailBase%")
                              ->orderBy('email', 'desc')
                              ->first();

            $nextNumber = $latestUser ? intval(str_replace([$emailBase, $emailDomain], '', $latestUser->email)) + 1 : 1;
            $newEmail = $emailBase . sprintf('%04d', $nextNumber) . $emailDomain;

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $newEmail,
                'password' => Hash::make($defaultPassword),
                'phone' => $validatedData['phone'],
                'role_id' => 2 
            ]);

            $designer = Designer::create([
                'user_id' => $user->id,
                'name' => $validatedData['name'],
                'phone' => $validatedData['phone'],
                'skills' => $validatedData['skills'],
            ]);

            if ($request->hasFile('image')) {
                $this->handleImageUpload($request, $designer, 'public/designers/');
            }

            DB::commit();
            return response()->json(['message' => 'Designer created successfully!', 'user' => $user, 'designer' => $designer]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create Designer and user.'], 500);
        }
    }
    public function update(Request $request, $id)
    {
        $designer = Designer::findOrFail($id); // Ensure designer exists

        $validatedData = $request->validate([
            'phone' => [
                'required',
                'string',
                'max:255',
                new PhoneNumber($designer->id) // Ignoring this designer's ID
            ],
            'skills' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
        ]);

        DB::beginTransaction();
        try {
            // Update the designer with the validated data
            $designer->update([
                'phone' => $validatedData['phone'],
                'skills' => $validatedData['skills']
            ]);

            // Handle image upload if there's a new image file
            if ($request->hasFile('image')) {
                $this->handleImageUpload($request, $designer, 'public/designers');
            }

            DB::commit();
            return response()->json([
                'message' => 'Designer updated successfully!',
                'designer' => $designer
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to update designer', 'error' => $e->getMessage()], 500);
        }
    }


    public function destroy($id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $designer = Designer::findOrFail($id);
            $user = User::findOrFail($designer->user_id);

            if ($designer->image) {
                $this->deleteImage($designer->image);
            }

            $designer->delete();
            $user->delete();

            DB::commit();
            return response()->json(['message' => 'Designer, associated user, and image deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error occurred while deleting designer and user: ' . $e->getMessage()], 500);
        }
    }
}
