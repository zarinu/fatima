<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    protected $table = 'lessons';

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function get_url() {
        return 'media/courses/' . $this->course->id . '/' . $this->content_path;
    }
}
