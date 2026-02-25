<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => 'required',
            'total_amount' => 'required,min:1,integer',
            'status' => 'required',
            'orderItems' => 'required',
            'orderItems.*.product_id' => 'required',
            'orderItems.*.quantity' => 'required,min:1,integer',
            'orderItems.*.unit_price' => 'required,numeric',
            'orderItems.*.sub_total' => 'required,numeric',
        ];
    }
}
