<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductsRequest extends FormRequest
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
            'name' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
            'quantity' => 'sometimes|required|integer',
            'shop_id' => 'sometimes|required|exists:shops,id',
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'Description is required',
            'price.numeric' => 'Price must be a numeric value',
            'quantity.integer' => 'Quantity must be an integer',
            'shop_id.exists' => 'Shop ID does not exist',
        ];
    }
}
