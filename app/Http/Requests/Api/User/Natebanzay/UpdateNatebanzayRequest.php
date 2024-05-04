<?php

namespace App\Http\Requests\Api\User\Natebanzay;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNatebanzayRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'string'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string'],
            'note' => ['nullable', 'string'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'item_id' => ['required', 'integer', 'exists:items,id'],
            'status' => ['required', 'string'],
            'photos' => 'nullable|array',
            'photos.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];

    }
}
