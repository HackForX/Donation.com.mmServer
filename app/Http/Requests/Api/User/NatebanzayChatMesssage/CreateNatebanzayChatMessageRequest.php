<?php

namespace App\Http\Requests\Api\User\NatebanzayChatMesssage;

use Illuminate\Foundation\Http\FormRequest;

class CreateNatebanzayChatMessageRequest extends FormRequest
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
            'chat_id' => ['required', 'integer', 'exists:natebanzay_chats,id'],
            'sender_id' => ['required', 'integer', 'exists:users,id'],
            'receiver_id' => ['required', 'integer', 'exists:users,id'],
            'message'=>['string','required', 'max:255']
        ];
    }
}
