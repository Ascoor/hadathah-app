<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SaleRep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function index()
    {
        $carts = Cart::with('customer', 'saleRep', 'cartDetails')->get();

        return response()->json($carts);
    }

    /**
     *  منطق أضافة سلة جديدة  
     */
    public function store(Request $request)
    {
        $request->validate([
            'created_by' => 'required|integer',
            'customer_id' => 'required|integer',
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer',
            'products.*.quantity' => 'required|integer',
            'products.*.price' => 'required|numeric',
            'products.*.discount' => 'nullable|numeric',
            'products.*.tax' => 'nullable|numeric',
        ]);

        try {
            DB::beginTransaction();

            $cart = Cart::create([
                'sale_rep_id' => $request->sale_rep_id ?? null,
                'customer_id' => $request->customer_id,
                'created_by' => $request->created_by,
                'status' => 'active', // حالة السلة الافتراضية
            ]);

            foreach ($request->products as $product) {
                CartDetail::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'discount' => $product['discount'] ?? 0,
                    'tax' => $product['tax'] ?? 0,
                ]);
            }

            DB::commit();

            return response()->json(['message' => 'تم إنشاء السلة بنجاح', 'cart_id' => $cart->id], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'حدث خطأ أثناء إنشاء السلة'], 500);
        }
    }
}