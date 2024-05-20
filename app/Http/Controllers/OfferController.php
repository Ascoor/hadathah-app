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
            'time_plementation_range' => 'required|string',
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
        'payment_type' => 'required|string',
        'created_by' => 'required|exists:users,id',
        'order_type.*' => 'required|string|in:service,designs_and_prints,promotional_products,marketing',
        'employees' => 'required|array',
        'time_plementation_range' => 'required|string',
        'employees.designer_id' => 'nullable|exists:designers,id',
        'employees.sale_rep_id' => 'nullable|exists:sale_reps,id',
        'employees.social_rep_id' => 'nullable|exists:social_reps,id',
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
    $order->payment_method = $data['payment_method'];
    $order->payment_type = $data['payment_type'];	
    $order->time_plementation_range = $data['time_plementation_range'];
 
    $order->created_by = $data['created_by'];
    $order->order_type = json_encode($data['order_type']); // Save order types as JSON
   
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
        $orderProduct->notes = $product['notes'];
        $orderProduct->save();
    }

    // Save employees related to the order
    $orderEmployee = new OrderEmployee();
    $orderEmployee->order_id = $order->id;
    $orderEmployee->designer_id = $data['employees']['designer_id'];
    $orderEmployee->sale_rep_id = $data['employees']['sale_rep_id'];
    $orderEmployee->social_rep_id = $data['employees']['social_rep_id'];
    $orderEmployee->save();

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
