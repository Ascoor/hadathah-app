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

}
