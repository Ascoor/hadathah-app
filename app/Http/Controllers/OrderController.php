<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with( ['customer', 'employees.saleRep', 'employees.socialRep', 'employees.designer','creator'])->get();
        
        return response()->json($orders);
    }


    public function show(Order $order)
    {
        $order = Order::with( ['customer', 'employees.saleRep', 'employees.socialRep','products', 'employees.designer','creator'])->find($order->id);
        return response()->json($order);
    }

    public function getByOffer($offerId)
    {
        // Query the orders table to find the order with the given offer_id
        $order = Order::where('offer_id', $offerId)->first();

        // Check if the order was found
        if ($order) {
            return response()->json([
                'success' => true,
                'orderId' => $order->id
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }
    }
}
