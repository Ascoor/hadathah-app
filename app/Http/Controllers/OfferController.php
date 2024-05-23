<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderEmployee;
use App\Models\OrderProduct;
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
            'payment_type' => 'required|string',
            'valid_until' => 'required|date',
            'time_plementation_range' => 'required|numeric',
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

public function convertToOrder(Request $request, $offerId)
{
    $offer = Offer::findOrFail($offerId);

    // Validate the request data
    $request->validate([
        'order_date' => 'required|date',
        'products' => 'required|array',
        'payment_method' => 'required|string',
        'sale_rep_id' => 'nullable|string',
        'designer_id' => 'nullable|string',
        'soical_rep_id' => 'nullable|string',
        'created_by' => 'required|exists:users,id',
        'order_type' => 'required|in:service,designs_and_prints,promotional_products' // Validate order type
    ]);

    $data = $request->all();

    $order = new Order();
    $order->offer_id = $offer->id;
    $order->customer_id = $offer->customer_id;
    $order->order_date = $data['order_date'];
    $order->total = $offer->total;
    $order->tax_rate = $offer->tax_rate;
    $order->discount_rate = $offer->discount_rate;
    $order->total_final = $offer->total_final;
    $order->payment_method = $offer->payment_method;
    $order->status = 'converted'; // Set status to converted
    $order->created_by = $offer->created_by;
    $order->order_type = $data['order_type']; // Set order type
    $order->save();

    // Update offer status to converted
    $offer->status = 'converted';
    $offer->save();

    // Create order products
    foreach ($data['products'] as $product) {
        $orderProduct = new OrderProduct();
        $orderProduct->order_id = $order->id;
        $orderProduct->product_id = $product['product_id'];
        $orderProduct->quantity = $product['quantity'];
        $orderProduct->price = $product['price'];
        $orderProduct->save();
    }
    foreach ($data['employees'] as $employee) {
        $orderEmployee = new OrderEmployee();
        $orderEmployee->order_id = $order->id;
        $orderEmployee->designer_id = $employee['designer_id'];
        $orderEmployee->sale_rep_id = $employee['sale_rep_id'];
        $orderEmployee->social_rep_id= $employee['social_rep_id'];
        $orderEmployee->save();
    }

    return response()->json([
        'message' => 'Order created successfully',
        'order' => $order,
        'products' => $order->orderProducts,
    ], 201);
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
