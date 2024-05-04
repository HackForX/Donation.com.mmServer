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
            'id' => $this->id,
            'uploader_id' => $this->natebanzay->user_id,
            'requester_id' => $this->user_id,
            'uploader' => $this->natebanzay->user,
            'requester' => $this->user,
            'natebanzay_id' => $this->natebanzay_id,
            'natebanzay' => $this->natebanzay->load('item')->load('user')   ,
            'status' => $this->status
        ];
    }
}
