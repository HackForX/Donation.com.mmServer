<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NatebanzayChat extends Model
{
    use HasFactory;
    protected $fillable=[
        'requester_id',
        'uploader_id',
    ];

    
    public function messages()
    {
        return $this->hasMany(NatebanzayChatMessage::class);
    }
}
