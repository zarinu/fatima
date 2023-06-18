<?php

namespace App\Models;

use App\Notifications\VerificationSMS;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Verification extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id', 'mobile', 'code', 'action', 'redirect_url',
        'created_at', 'updated_at', 'verified_at', 'expired_at'
    ];

    public function send_code() {
        $this->notify(new VerificationSMS($this));
        return true;
    }
}
