<?php

namespace App\Http\Controllers;

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
            'name' => 'required|string|max:255',
            'notes' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'contact_number' => 'required|string|min:10|max:11',
            'gender' => 'required|in:ذكر,انثى',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);
    

        $customer = Customer::create($validatedData);
        return response()->json($customer, 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'notes' => 'nullable|string|max:255',
        'address' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'contact_number' => 'required|string|min:10|max:11',
        'gender' => 'required|in:ذكر,انثى',
        'city' => 'required|string|max:255',
        'country' => 'required|string|max:255',
    ]);

    $customer = Customer::findOrFail($id); // Ensure the customer exists, or fail with 404
    $customer->update($validatedData);

    return response()->json($customer, 200);
}


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
