<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserViewedLesson extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'user_viewed_lessons';
}
