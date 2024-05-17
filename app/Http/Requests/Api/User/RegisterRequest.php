<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'age' => 'required|string',
            'gender' => 'required|string',

            'phone' => [
                'required',
                'string',
                'unique:users,phone',
                // 'regex:/^(?:\+959|09)\d+$/'
            ],
            'password' => ['required', 'string',],
        ];
    }
}
