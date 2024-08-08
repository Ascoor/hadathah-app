<?php

namespace App\Http\Controllers;

use App\Rules\PhoneNumber;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:customers',
            'email' => 'nullable|string|email|max:255|unique:customers',
            'phone' => ['required', 'string', 'max:255'], // Remove the PhoneNumber rule temporarily
            'gender' => 'required|in:ذكر,أنثى',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'notes' => 'nullable|string|max:255',
        ]);

        // Format phone number
        $validatedData['phone'] = $this->formatPhoneNumber($validatedData['phone']);

        $customer = Customer::create($validatedData);
        return response()->json($customer, 201);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:customers,id,' . $id,
            'notes' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:customers',
            'phone' => ['required', 'string', 'max:255'], // Remove the PhoneNumber rule temporarily
            'gender' => 'required|in:ذكر,أنثى',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        // Format phone number
        $validatedData['phone'] = $this->formatPhoneNumber($validatedData['phone']);

        $customer = Customer::findOrFail($id); // Ensure the customer exists, or fail with 404
        $customer->update($validatedData);

        return response()->json($customer, 200);
    }

    private function formatPhoneNumber($phone)
    {
        // Remove any spaces from the phone number
        $phone = str_replace(' ', '', $phone);

        // Check if phone starts with '+', if not, add it or convert '00' to '+'
        if (!str_starts_with($phone, '+')) {
            if (str_starts_with($phone, '00')) {
                $phone = '+' . substr($phone, 2);
            } else {
                $phone = '+' . $phone;
            }
        }

        return $phone;
    }



    /**
     * Search for customers by name or email or contact number
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function destroy(Customer $customer)
     {
         $customer->delete();
         return response()->json(null, 204); // HTTP 204 No Content
     }
}
