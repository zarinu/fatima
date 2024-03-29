<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    protected $table = 'lessons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'course_id', 'chapter_id', 'title', 'description', 'content_path', 'type', 'order',
        'previous_lesson_id', 'next_lesson_id',
    ];

    public static array $types = [
        'video' => 'ویدیویی',
        'audio' => 'صوتی',
        'image' => 'تصویری',
        'file' => 'فایل(pdf)',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function get_url() {
        return 'media/courses/' . $this->course->id . '/' . $this->content_path;
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    public function previousLesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'previous_lesson_id');
    }

    public function nextLesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'next_lesson_id');
    }

    public function lessonImages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LessonImage::class);
    }

    public function is_complete(): bool
    {
        if(!auth()->check()) {
            return false;
        }

        $lesson_viewed = UserViewedLesson::where([
            'user_id' => auth()->id(),
            'lesson_id' => $this->id,
        ])->first();

        if(empty($lesson_viewed)) {
            return false;
        }
        return $lesson_viewed->is_complete;
    }
}
