<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    use HasFactory;
    protected $table = 'privacy_policy';
    protected $fillable = ['heading_1','heading_1_des','heading_2','heading_2_des'];
}
