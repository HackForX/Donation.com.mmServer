<?php

namespace App\Http\Requests\Api\User\Donor;

use Illuminate\Foundation\Http\FormRequest;

class CreateDonorRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
            ],
            'phone' => [
                'required',
                'string',
            ],
            'address' => [
                'required',
                'string',
            ],
            'business' => [
                'required',
                'string',
            ],
            'position' => [
                'required',
                'string',
            ],
            'user_id'=>[
                'exists:users,id'
            ],
            'document'=>[
                'required',
                'image', // ensure it's an image file
                'mimes:jpeg,png,jpg,gif', // allow only specific image formats
                'max:2048', // set m
              
            ],
            'document_number'=>[
                'required',  
            ]
        ];
    }
}
