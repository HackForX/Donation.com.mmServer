<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NatebanzayRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'user' => $this->user,
            'natebanzay_id' => $this->natebanzay_id,
            'natebanzay' => $this->natebanzay,
            'status' => $this->status
        ];
    }
}
