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
        if(!empty($this->cover_path)) {
            return '/assets/images/courses/' . $this->id . '/' . $this->cover_path;
        }
        return '/assets/images/default/cover.jpg';
    }

    public function get_banner() {
        if(!empty($this->banner_path)) {
            return '/assets/images/courses/' . $this->id . '/' . $this->banner_path;
        }
        return '/assets/images/default/banner.jpg';
    }

    public function get_url() {
        return '/courses/' . $this->id;
    }
}
