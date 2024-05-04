<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'type',
        'category_id'
    ];
    public function category()
    {
    return $this->belongsTo(Category::class);
    }

    public function sadudithars()
    {
        return $this->hasMany(Sadudithar::class);
    }
}
