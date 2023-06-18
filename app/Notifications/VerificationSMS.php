<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Kavenegar\Laravel\Message\KavenegarMessage;
use Kavenegar\Laravel\Notification\KavenegarBaseNotification;

class VerificationSMS extends KavenegarBaseNotification implements ShouldQueue
{
    use Queueable;
    private $notifiable;

    public function __construct($notifiable)
    {
        $this->notifiable = $notifiable;
    }

    public function toKavenegar($notifiable): KavenegarMessage
    {
        return (new KavenegarMessage())
            ->verifyLookup(env('SMS_VERIFY_TEMPLATE', 'Verify'),[$this->notifiable->code])->to($this->notifiable->mobile);
    }
}
