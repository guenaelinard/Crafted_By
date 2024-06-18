<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class StoreProductsRequest extends FormRequest
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
        'name' => 'required|string|unique:products,name',
        'description' => 'required|string',
        'story' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'required|string',
        'color' => 'required|string',
        'size' => 'required|string',
        'category' => 'required|string',
//        'shop_id' => 'required|exists:shops,id',
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

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */

    public function messages(): array {
        return [
            'name.max' => 'The name must not exceed 100 characters',
            'stock.integer' => 'The stock must be an integer',
            'shop_id.uuid' => 'The shop ID must be a UUID',
            'shop_id.not_exists' => 'The shop ID does not exist'
        ];
    }
}
