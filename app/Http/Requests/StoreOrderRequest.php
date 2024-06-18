<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreOrderRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'command_number' => 'required',
            'user_id' => 'required|exists:users,id',
            'datetime' => 'required|date',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ]));
    }

public function messages(): array
{
    return [
        'order_id.integer' => 'Order ID must be an integer',
        'product_id.integer' => 'Product ID must be an integer',
        'user_id.integer' => 'User ID must be an integer',
        'quantity.integer' => 'Quantity must be an integer',
        'price.numeric' => 'Price must be a numeric value',
        'status.string' => 'Status must be a string',
    ];
}
}
