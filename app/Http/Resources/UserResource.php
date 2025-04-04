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
            'age' => $this->age,
            'gender' => $this->gender,
            'role'=>$this->getRoleName(),
            'email'=>$this->email,
            'address'=>$this->address,
            'document' => $this->document,
            'is_show'=>$this->is_show,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
    protected function getRoleName(): string
    {
        return $this->roles->isNotEmpty() ? $this->roles->last()->name : 'No role assigned';
    }
}
