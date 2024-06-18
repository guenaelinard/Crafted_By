<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string|array>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|unique:users,username',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'required|string|min:8',
            'email' => 'required|string|email|unique:users,email',
            'address' => 'required|string',
            'city' => 'required|string',
            'zipcode' => 'required|string',
            'phone_number' => 'required|string',
            'image' => 'required|string',
        ];
    }
}
