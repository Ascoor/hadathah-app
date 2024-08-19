<?php
namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use App\Events\UserPermissionsUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all()->groupBy('section');
        return response()->json($permissions);
    }

    public function getUserPermissions($userId)
    {
        $user = User::findOrFail($userId);
        $permissions = $user->permissions()->get();
        return response()->json($permissions);
    }
    public function updateUserPermissions(Request $request, $userId)
    {
        // الحصول على المستخدم بواسطة معرفه
        $user = User::findOrFail($userId);
    
        // الحصول على المدخلات الخاصة بالصلاحيات من الطلب
        $permissionsInput = $request->input('permissions');
    
        // إزالة الصلاحيات الحالية
        $user->permissions()->detach();
    
        // إضافة الصلاحيات الجديدة
        foreach ($permissionsInput as $perm) {
            $user->permissions()->attach($perm['permission_id'], ['enabled' => $perm['enabled']]);
        }
    
        // جمع الصلاحيات المحدثة بعد الإضافة
        $updatedPermissions = $user->permissions()->pluck('name');
    
        // إطلاق الحدث بعد التحديث
        event(new UserPermissionsUpdated($user->id, $updatedPermissions));
    
        return response()->json(['message' => 'Permissions updated successfully!']);
    }
    

    public function getPermissions($userId)
    {
        $user = User::findOrFail($userId);
        $permissions = $user->permissions;
        return response()->json($permissions);
    }

    public function streamPermissions($userId)
    {
        try {
            $user = User::findOrFail($userId);

            return response()->stream(function () use ($user) {
                while (true) {
                    $permissions = $user->permissions;
                    echo "data: " . json_encode($permissions) . "\n\n";
                    ob_flush();
                    flush();
                    sleep(15);
                }
            }, 200, [
                'Content-Type' => 'text/event-stream',
                'Cache-Control' => 'no-cache',
                'Connection' => 'keep-alive',
            ]);
        } catch (\Exception $e) {
            Log::error("SSE stream error: " . $e->getMessage());
            return response()->json(['error' => 'Unable to stream permissions'], 500);
        }
    }
}
