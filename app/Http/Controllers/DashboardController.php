<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Designer;
use App\Models\Product;
use App\Models\SaleRep;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'customers' => Customer::count(),
            'products' => Product::count(),
            'designers' => Designer::count(),
            'sales' => SaleRep::count(),
        ]);
}
}