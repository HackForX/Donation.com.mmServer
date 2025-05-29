<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'phone',
        'business',
        'position',
        'document_number',
        'front_nrc',
        'back_nrc',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
