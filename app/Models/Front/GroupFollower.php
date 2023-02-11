<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupFollower extends Model
{
    use HasFactory;
    protected $table = 'group_followers';
    protected $fillable = [
        'group_id',
        'follower_id',
        'is_active',
    ];
}
