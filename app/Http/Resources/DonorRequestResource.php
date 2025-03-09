<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DonorRequestResource extends JsonResource
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
            'name'=>$this->name,
            'phone'=>$this->phone,
            'address'=>$this->address,
            'user_id'=>$this->user_id,
            'document'=>$this->document,
            'document_number'=>$this->document_number,
            'business'=>$this->business,
            'position'=>$this->position,
            'status'=>$this->status,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
