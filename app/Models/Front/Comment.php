<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = [
        'post_id',
        'user_id',
        'comment',
        'status',
        'created_at',
        'updated_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
