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

}
