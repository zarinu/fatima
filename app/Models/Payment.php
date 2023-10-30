<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    protected $table = 'payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'order_id', 'amount', 'ref_id',
        'name', 'mobile', 'description', 'status', 'paid_at',
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public static function paymentUrl($url_type) {
        return config('payment.zarinpal')[env('ZARINPAL_STATUS')][$url_type];
    }
}
