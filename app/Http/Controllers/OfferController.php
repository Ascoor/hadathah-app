<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $offers = Offer::with('customer', 'saleRep', 'creator')->get();
        return response()->json($offers);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'offer_number' => 'required|string|unique:offers',
            'customer_id' => 'required|exists:customers,id',
            'sale_rep_id' => 'required|exists:sale_reps,id',
            'offer_date' => 'required|date',
            'products' => 'required|array',
            'total' => 'required|numeric',
            'tax_rate' => 'required|numeric',
            'discount_rate' => 'required|numeric',
            'total_final' => 'required|numeric',
            'payment_method' => 'required|string',
            'transaction_id' => 'nullable|string',
            'payment_type' => 'required|string',
            'valid_until' => 'required|date',
            'created_by' => 'required|exists:users,id',
        ]);
    
        $offer = new Offer($data);
        $offer->products = $data['products']; // Assuming products are stored as JSON in the database
        $offer->save();
    
        return response()->json(['message' => 'Offer created successfully!', 'offer' => $offer]);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
{   
    // Load offer data
    $offerData = Offer::with('customer', 'saleRep', 'creator')->find($offer->id);


    // Return the offer data with products in the response
    return response()->json($offerData);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        //
    }
}
