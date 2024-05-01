<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaduditharComment extends Model
{
    use HasFactory;
    protected $fillable = ['sadudithar_id', 'comment','user_id'];
    public function sadudithar()
    {
        return $this->belongsTo(Sadudithar::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
