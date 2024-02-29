<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonImage extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    protected $table = 'lesson_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'course_id', 'lesson_id', 'caption', 'image_path',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function lesson() {
        return $this->belongsTo(Lesson::class);
    }

    public function get_url() {
        return 'media/courses/' . $this->course_id . '/lesson_images/' . $this->image_path;
    }
}
