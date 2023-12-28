<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartPayment extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    protected $table = 'cart_payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name', 'phone', 'tracking_code', 'card_number', 'description', 'paid_date', 'payment_image',
    ];
}
