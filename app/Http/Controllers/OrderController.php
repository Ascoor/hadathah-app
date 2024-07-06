<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderEmployee;
use App\Models\OrderProduct;
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
 
    public function getOrderDetails($orderId)
    {
        $orderDetails = OrderDetail::where('order_id', $orderId)->first();

        if ($orderDetails) {
            return response()->json($orderDetails);
        } else {
            return response()->json(['message' => 'Order details not found'], 404);
        }
    }
    public function store(Request $request)
{
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

    // Generate the order number
    $lastOrderNumber = Order::max('order_number');
    if ($lastOrderNumber) {
        $numericPart = intval(substr($lastOrderNumber, 4));
        $newNumericPart = str_pad($numericPart + 1, 6, '0', STR_PAD_LEFT);
        $newOrderNumber = 'HT-' . $newNumericPart;
    } else {
        $newOrderNumber = 'HT-000001';
    }

    $order = new Order();
    $order->order_number = $newOrderNumber;
    $order->customer_id = $data['customer_id'];
    $order->order_date = $data['order_date'];
    $order->total = array_sum(array_column($data['products'], 'total'));
    $order->tax_rate = $data['tax_rate'];
    $order->discount_rate = $data['discount_rate'];
    $order->total_final = $data['total_final'];
    $order->payment_method = $data['payment_method'];
    $order->payment_type = $data['payment_type'];
    $order->time_plementation_range = $data['time_plementation_range'];
    $order->created_by = $data['created_by'];
    $order->order_type = json_encode($data['order_type']); // Save order types as JSON
    $order->save();

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


public function destroy(Order $order)
{
    // Delete related order details
    OrderDetail::where('order_id', $order->id)->delete();

    // Delete related order employees
    OrderEmployee::where('order_id', $order->id)->delete();

    // Delete related order products
    OrderProduct::where('order_id', $order->id)->delete();

    // Delete the order itself
    $order->delete();

    return response()->json([
        'message' => 'Order and related data deleted successfully'
    ], 200);
}
}