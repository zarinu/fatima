<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Kavenegar\Laravel\Message\KavenegarMessage;
use Kavenegar\Laravel\Notification\KavenegarBaseNotification;

class SuccessPayment extends KavenegarBaseNotification implements ShouldQueue
{
    use Queueable;

    private $mobile;
    private $template;
    private $token;

    public function __construct($mobile, $template, $token)
    {
        $this->mobile = $mobile;
        $this->template = $template;
        $this->token = $token;
    }

    public function toKavenegar($notifiable): KavenegarMessage
    {
        return (new KavenegarMessage())
            ->verifyLookup($this->template, [$this->token])
            ->to($this->mobile);
    }
}
