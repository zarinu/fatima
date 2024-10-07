<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    protected $table = 'articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'title', 'abstract', 'content', 'tags', 'has_image', 'has_video',
        'likes', 'views', 'estimated_time', 'difficulty_level', 'order', 'status',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static array $statuses = [
        'active' => 'فعال',
        'inactive' => 'غیر فعال',
    ];

    public static array $difficulty_levels = [
        'beginner' => 'مقدماتی',
        'intermediate' => 'متوسط',
        'advanced' => 'حرفه ای',
    ];

    public static array $statusesLabels = [
        'active' => 'badge badge-success',
        'inactive' => 'badge badge-danger',
    ];

    public function get_image() {
        if($this->has_cover) {
            return '/media/courses/' . $this->id . '/cover.jpg';
        }
        return '/assets/images/default/cover.jpg';
    }

    public function get_video() {
        if($this->has_video) {
            return '/media/courses/' . $this->id . '/video.mp4';
        }
        return null;
    }
}
