<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Front\Friend;
use App\Models\Front\Story;
use App\Models\Front\Message;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'full_name',
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'password',
        'reset_password_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function friends1()
    {
        return $this->hasMany(Friend::class, 'user_id');
    }

    public function friends2()
    {
        return $this->hasMany(Friend::class, 'friend_id');
    }
    public function friends()
    {
        return $this->belongsTo(Friend::class, 'id','user_id')->where('friend_id','=', auth()->user()->id)->withDefault();
    }
    public function cards()
    {
        return $this->hasMany(UserCard::class,'user_id');
    }
    public function stories()
    {
        return $this->hasMany(Story::class);
    }
}