<?php

namespace App\Http\Requests\Api\Admin\Sadudithar;

use App\Rules\EventDateFormat;
use Illuminate\Foundation\Http\FormRequest;

class CreateSaduditharRequest extends FormRequest
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
            'category_id' => 'required|integer|exists:categories,id',
            'subcategory_id' => 'required|integer|exists:sub_categories,id',
            'city_id' => 'required|integer|exists:cities,id',
            'township_id' => 'required|integer|exists:townships,id',
            'type' => 'required|string|in:food,item',
            'user_id' => 'required|integer|exists:users,id',
            'estimated_amount' => 'required|numeric',
            'estimated_time' => 'required|string',
            'estimated_quantity' => 'required|string',
            'actual_start_time' => 'required',
            'actual_end_time' => 'required',
            'event_date' => 'required',
            'is_open' => 'nullable',
            'is_show' => 'nullable',
            'address' => 'required|string|max:255',
            'phone' => 'required|string',
            'image' => 'nullable',
            'status' => 'required|string',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ];
    }
}
