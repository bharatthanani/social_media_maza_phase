<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $table="educations";
    protected $fillable = [
        'user_id',
        'education',
        'institution',
        "employment",
        "year",
    ];
}
