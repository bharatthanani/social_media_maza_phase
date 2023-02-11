<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Friend extends Model
{
    protected $table = 'friends';
    protected $fillable = [
        'user_id',
        'friend_id',
        'status',
        'created_at',
        'updated_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function mfriends1()
    {
        return $this->hasMany(User::class, 'id','user_id');
    }

    public function mfriends2()
    {
        return $this->hasMany(User::class, 'id','friend_id');
    }
}
