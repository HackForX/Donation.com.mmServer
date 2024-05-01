<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sadudithar extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'city_id',
        'township_id',
        'user_id',
        'subCategory_id',
        'estimated_amount',
        'estimated_time',
        'estimated_quantity',
        'actual_start_time',
        'actual_end_time',
        'event_date',
        'is_open',
        'is_show',
        'address',
        'phone',
        'image',
        'status',
        'latitude',
        'longitude'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function township()
    {
        return $this->belongsTo(Township::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function likes()
    {
        return $this->hasMany(SaduditharLike::class);
    }
    public function views()
    {
        return $this->hasMany(SaduditharView::class);
    }
    public function comments()
    {
        return $this->hasMany(SaduditharComment::class);
    }
}
