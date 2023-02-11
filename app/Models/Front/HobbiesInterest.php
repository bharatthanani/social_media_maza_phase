<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HobbiesInterest extends Model
{
    use HasFactory;
    protected $table="hobbies_interests";
    protected $fillable = [
        'user_id',
        'hobbies',
        'music',
        "tv",
        "books",
        "movies",
        "activities",
    ];
}
