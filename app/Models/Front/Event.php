<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = [
        'user_id',
        'event_title',
        'event_location',
        'event_date',
        'event_cover_img',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function follower()
    {
        return $this->belongsTo(EventFollower::class, 'id','event_id')->where('follower_id','=', auth()->user()->id)->withDefault();
    }
    public function followers()
    {
        return $this->hasMany(EventFollower::class)->latest()->take(3);
    }
    public function totalfollowers()
    {
        return $this->hasMany(EventFollower::class);
    }
    public function is_follower()
    {
        return $this->belongsTo(EventFollower::class, 'id','event_id')->where('follower_id','=', auth()->user()->id)->withDefault();
    }
}
