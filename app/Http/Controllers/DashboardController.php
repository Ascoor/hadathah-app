<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Designer;
use App\Models\MultiEmployee;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Order;
use App\Models\SaleRep;
use App\Models\SocialRep;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $designersCount = Designer::count();
        $saleRepsCount = SaleRep::count();
        $socialRepsCount = SocialRep::count();
        $multiEmployeeCount = MultiEmployee::count();
     
        $employeesCount = $designersCount + $saleRepsCount + $socialRepsCount + $multiEmployeeCount;
        return response()->json([
            'customers' => Customer::count(),
            'products' => Product::count(),
            'employees' => $employeesCount,

            'sales' => SaleRep::count(),
            'offers' => Offer::count(),
            'orders' =>  Order::count()
        ]);
}
}