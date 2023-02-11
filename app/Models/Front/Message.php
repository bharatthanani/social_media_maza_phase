<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Message extends Model
{
    use HasFactory;
    protected $table = 'messages';
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'is_read',
        'time_at',
        'created_at',
        'updated_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function senders()
    {
        return $this->hasMany(User::class, 'id','sender_id');
    }

    public function receivers()
    {
        return $this->hasMany(User::class, 'id','receiver_id');
    }
}
