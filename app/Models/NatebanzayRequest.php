<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NatebanzayRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'status',
        'natebanzay_id'
    ];

    public function natebanzay()
    {
        return $this->belongsTo(Natebanzay::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
