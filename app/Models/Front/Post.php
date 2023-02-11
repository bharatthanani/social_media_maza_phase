<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    protected $table="posts";
    protected $fillable = [
        'user_id',
        'title',
        'post_type'
    ];
    public function medias()
    {
        return $this->hasMany(PostMedia::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
