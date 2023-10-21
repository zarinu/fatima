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
        'not_for_sale' => 'غیر قابل فروش',
        'inactive' => 'غیر فعال',
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

    public static function calculate_discounted_price($price, $discount_percent): float|int
    {
        return $price * (100 - $discount_percent) / 100;
    }
}
