<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    protected $table = 'discounts';
    protected $dates = ['start_at', 'expire_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'code', 'type', 'value', 'count',
        'start_at', 'expire_at',
    ];

    public static array $types = [
        'percentage' => 'درصدی',
        'numeric' => 'عددی',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
