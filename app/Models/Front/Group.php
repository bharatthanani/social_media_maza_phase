<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Group extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $fillable = [
        'user_id',
        'group_title',
        'group_privacy_type',
        'group_profile_img',
        'group_cover_img',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function follower()
    {
        return $this->belongsTo(GroupFollower::class, 'id','group_id')->where('follower_id','=', auth()->user()->id)->withDefault();
    }
}
