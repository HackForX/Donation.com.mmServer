<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaduditharCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'sadudithar_id' => $this->sadudithar_id,
            'user_Id' => $this->user_id,
            'comment' => $this->comment,
            'user' => $this->user,
            'created_at' => $this->created_at
        ];
    }
}
