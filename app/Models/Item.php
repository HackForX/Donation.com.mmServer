<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'is_active',

    ];
    public function subItems()
    {
        return $this->hasMany(SubItem::class);
    }
    public function natebanzays()
    {
        return $this->hasMany(Natebanzay::class);
    }
}
