<?php

namespace App\Http\Requests\Api\Admin\DonorRequest;

use Illuminate\Foundation\Http\FormRequest;

class ApproveDonorRequest extends FormRequest
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
            'donor_request_id' => [
                'required',
                'exists:donor_requests,id'
            ]
        ];
    }
}
