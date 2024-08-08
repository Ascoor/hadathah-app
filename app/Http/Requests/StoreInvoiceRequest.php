<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   
    public function rules(): array
    {
        return [
            'invoice_date' => 'required|date',
            'invoice_number' => 'required|string|unique:invoices,invoice_number',
            'order_id' => 'required|exists:orders,id',
            'customer_id' => 'required|exists:customers,id',
            'total_before_discount_and_tax' => 'required|numeric',
            'total_after_discount_and_tax' => 'required|numeric',
            'discount_amount' => 'required|numeric',
            'tax_amount' => 'required|numeric',
            'status' => 'required|string',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric',
            'products.*.total' => 'required|numeric',
        ];
    }
}
