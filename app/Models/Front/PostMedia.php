<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMedia extends Model
{
    use HasFactory;
    protected $table="post_medias";
    protected $fillable = [
        'post_id',
        'media',
        'media_type',
    ];
}
