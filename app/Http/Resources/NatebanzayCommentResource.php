<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NatebanzayCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'natebanzay_id' => $this->natebanzay_id,
            'user_id' => $this->user_id,
            'comment' => $this->comment,
            'user' => $this->user,
            'created_at' => $this->created_at
        ];
    }
}
