<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $table="abouts";
    protected $fillable = [
        'user_id',
        'about_function',
        'company',
        "web",
        "member",
        "joining_date",
    ];
}
