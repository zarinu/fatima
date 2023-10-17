<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }

    public static array $statuses = [
        'completed' => 'تکمیل شده',
        'pre-sell' => 'پیش فروش',
        'presenting' => 'در حال تکمیل',
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

    public function get_url() {
        return '/courses/' . $this->id;
    }
}
