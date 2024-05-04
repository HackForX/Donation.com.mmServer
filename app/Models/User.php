<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'password',
        'profile',
        'document_number',
        'document',
        'device_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    public $guard_name = 'api';
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function donorRequests()
    {
        return $this->hasMany(DonorRequest::class);
    }
    public function sadudithars()
    {
        return $this->hasMany(Sadudithar::class);
    }
    public function natebanzays()
    {
        return $this->hasMany(Natebanzay::class);
    }
    public function natebanzayRequests()
    {
        return $this->hasMany(NatebanzayRequest::class);
    }
    public function saduditharComments()
    {
        return $this->hasMany(SaduditharComment::class);
    }

    public function saduditharLikes(){
        return $this->hasMany(SaduditharLike::class); // A user can like/dislike many posts
    }
    public function saduditharViews(){
        return $this->hasMany(SaduditharView::class); // A user can like/dislike many posts
    }

    public function notifications(){
        return $this->hasMany(Notification::class); // A user can like/dislike many posts
    }

    public function providers()
    {
        return $this->hasMany(Provider::class,'user_id','id');
    }
    public function messages(){
        return $this->hasMany(NatebanzayChatMessage::class);
    }
}
