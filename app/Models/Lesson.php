<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function show_url() {
        return '/panel/courses/' . $this->course->id . '/' . $this->id;
    }

    public function download_url() {
        return 'media/courses/' . $this->course->id . '/' . $this->content_path;
    }
}
