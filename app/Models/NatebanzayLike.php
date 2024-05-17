<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NatebanzayLike extends Model
{
    use HasFactory;
    protected $fillable=[
        'natebanzay_id',
        'user_id',
        'like'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
