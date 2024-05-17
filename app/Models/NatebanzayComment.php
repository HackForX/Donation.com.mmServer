<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NatebanzayComment extends Model
{
    use HasFactory;

    protected $fillable = ['natebanzay_id', 'comment','user_id'];
    public function natebanzay()
    {
        return $this->belongsTo(Natebanzay::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
