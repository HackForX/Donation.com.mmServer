<?php

namespace App\Http\Requests\Api\Admin\Sadudithar;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSaduditharRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id', // Category ID is required
            'city_id' => 'required|integer|exists:cities,id', // City ID is required
            'township_id' => 'required|integer|exists:townships,id',
            'subCategory_id' => 'required|integer|exists:sub_categories,id',
            'estimated_amount' => 'required|numeric',
            'estimated_time' => 'required|string',
            'estimated_quantity' => 'required|integer',
            'actual_start_time' => 'required',
            'actual_end_time' => 'required',
            'event_date' => 'required',
            'is_open' => 'required|boolean',
            'is_show' => 'required|boolean',
            'address' => 'required|string|max:255',
            'phone' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ];
    }
}
