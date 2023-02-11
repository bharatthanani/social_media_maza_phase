<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpSupport extends Model
{
    use HasFactory;
    protected $table = 'help_support';
    protected $fillable = ['title','description'];
}
