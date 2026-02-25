<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'id'=>'required',
            'customer_name' => 'string',
            'total_amount' => 'integer',
            'status' => 'string',
            'orderItems' => 'sometime',
            'orderItems.*.product_id' => 'integer',
            'orderItems.*.quantity' => 'integer',
            'orderItems.*.unit_price' => 'numeric',
            'orderItems.*.sub_total' => 'numeric',
        ];
    }
}
