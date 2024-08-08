<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of invoices with related data.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all invoices with their related order and customer data
        $invoices = Invoice::with(['order', 'customer', 'details.product'])->get();

        return response()->json([
            'invoices' => $invoices
        ]);
    }
    
    public function checkInvoice($orderId)
    {
        $invoice = Invoice::where('order_id', $orderId)->first();
        if ($invoice) {
            return response()->json(['exists' => true, 'invoice' => $invoice]);
        } else {
            return response()->json(['exists' => false]);
        }
    }

    public function store(StoreInvoiceRequest $request)
    {
        DB::beginTransaction();
        try {
            $invoiceNumber = Invoice::generateInvoiceNumber();
            // إنشاء الفاتورة
            $invoice = Invoice::create([
                'invoice_date' => $request->invoice_date,
                
                'invoice_number' => $invoiceNumber,
                'order_id' => $request->order_id,
                'customer_id' => $request->customer_id,
                'total_before_discount_and_tax' => $request->total_before_discount_and_tax,
                'total_after_discount_and_tax' => $request->total_after_discount_and_tax,
                'discount_amount' => $request->discount_amount,
                'tax_amount' => $request->tax_amount,
                'status' => $request->status,
            ]);

            // إنشاء تفاصيل الفاتورة
            foreach ($request->products as $product) {
                InvoiceDetail::create([
                    'invoice_id' => $invoice->invoice_id,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'total' => $product['total'],
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Invoice created successfully',
                'invoice' => $invoice
            ], 201);

        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Failed to create invoice',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}