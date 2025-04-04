<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active'
    ];

    public function townships()
    {
    return $this->hasMany(Township::class);
    }

    public function sadudithars()
    {
        return $this->hasMany(Sadudithar::class);
    }
}
