<?php

namespace App\Http\Requests\Api\Admin\SubCategory;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubCategoryRequest extends FormRequest
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
                'unique:sub_categories,name'
            ],
            'type' => [
                'required',
                'string',
                'in:food,item'
            ],
            'category_id'=>[
                'required',
                'exists:categories,id'
            ]
        ];
    }
}
