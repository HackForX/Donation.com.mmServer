<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaduditharLike extends Model
{
    use HasFactory;
    protected $fillable = [
        'sadudithar_id',
        'user_id',
        'like'
    ];
}
