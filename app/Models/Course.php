<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    protected $table = 'courses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'name', 'summery', 'teacher_name', 'description', 'has_cover', 'has_video',
        'total_hours', 'price', 'discount_percent', 'order', 'status', 'private_description',
        'rate', 'score',
    ];

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public static array $statuses = [
        'completed' => 'تکمیل شده',
        'pre-sell' => 'پیش فروش',
        'presenting' => 'در حال تکمیل',
        'not_for_sale' => 'غیر قابل فروش',
        'inactive' => 'غیر فعال',
    ];

    public static array $statusesLabels = [
        'completed' => 'badge badge-success',
        'pre-sell' => 'badge badge-info',
        'presenting' => 'badge badge-warning',
        'not_for_sale' => 'badge badge-light',
        'inactive' => 'badge badge-dark',
    ];

    public function get_cover() {
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

    public function comments() {
        return $this->hasMany(Comment::class, 'item_id')->where('item', 'course');
    }
}
