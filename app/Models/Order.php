<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'payment_id', 'price', 'discount_price',
        'total_price', 'description', 'status',
    ];

    public static array $statuses = [
        'pending' => 'در حال بررسی',
        'failed' => 'ناموفق',
        'success' => 'موفق',
    ];

    public static array $statusesLabels = [
        'pending' => 'badge badge-warning',
        'failed' => 'badge badge-danger',
        'success' => 'badge badge-success',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
