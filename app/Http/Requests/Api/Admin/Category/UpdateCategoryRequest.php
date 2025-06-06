<?php

namespace App\Http\Requests\Api\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
              
                'string',
                // 'unique:categories,name'
            ],
            'type' => [
              
                'string',
                'in:food,item'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The category name is required',
            'name.unique' => 'The category name already exists.',
            'type.required' => 'The category type is required.',
            'type.in' => 'The category type must be either "food" or "item".',
        ];
    }
}
