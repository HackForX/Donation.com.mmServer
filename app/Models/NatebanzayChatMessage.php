<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NatebanzayChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'sender_id',
        'receiver_id',
        'message'
    ];

    public function chat(){
        return $this->belongsTo(NatebanzayChat::class,'chat_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
 
}
