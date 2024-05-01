<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active',
        'city_id',
        'city_name'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function sadudithars()
    {
        return $this->hasMany(Sadudithar::class);
    }
}
