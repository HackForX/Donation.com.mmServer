<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Natebanzay extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'quantity',
        'address',
        'phone',
        'note',
        'user_id',
        'photos',
        'item_id',
        'status',
        'note'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function natebanzayRequests()
    {
        return $this->hasMany(NatebanzayRequest::class);
    }
    public function likes()
    {
        return $this->hasMany(NatebanzayLike::class);
    }
    public function views()
    {
        return $this->hasMany(NatebanzayView::class);
    }
    public function comments()
    {
        return $this->hasMany(NatebanzayComment::class);
    }
}
