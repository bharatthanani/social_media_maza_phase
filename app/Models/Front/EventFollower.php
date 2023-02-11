<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class EventFollower extends Model
{
    use HasFactory;
    protected $table = 'event_followers';
    protected $fillable = [
        'event_id',
        'follower_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'follower_id');
    }
}
