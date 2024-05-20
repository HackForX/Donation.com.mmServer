<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'phone' => $this->phone,
            'profile' => $this->profile,
            'role'=>$this->getRoleName(),
            'address'=>$this->address,
            'document' => $this->document,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
    protected function getRoleName(): string
    {
        return $this->roles->isNotEmpty() ? $this->roles->last()->name : 'No role assigned';
    }
}
