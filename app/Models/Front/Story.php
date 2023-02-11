<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Story extends Model
{
    use HasFactory;
    protected $table = 'stories';
    protected $fillable = [
        'user_id',
        'title',
        'media_type_id',
        'media_name',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
