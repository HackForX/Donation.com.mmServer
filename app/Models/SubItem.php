<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubItem extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'is_active',
        'item_id'
    ];

    public function item()
    {
    return $this->belongsTo(Item::class);
    }
}
