<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class SendTelegramBot extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ["telegram"];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toTelegram($notifiable)
    {
        $HttpDebug = env('TELEGRAM_URL_PROXY');
        $TokenBot = env('TELEGRAM_BOT_TOKEN');
        $ChatId =env('TELEGRAM_CHAT_ID');

        $TelegramApiUrl = "https://api.telegram.org/bot{$TokenBot}/SendMessage?chat_id={$ChatId}&text=test";

        $Payloads = [
            "UrlBox"       => $TelegramApiUrl,
            "AgentList"    => "MOzilla Firefox",
            "VersionsList" => "HTTP/1.1",
            "MethodList"   => "POST"
        ];

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withOptions([
                'verify' => false,  // Disable SSL verification
            ])->post($HttpDebug, $Payloads);

            if ($response->successful()) {
                $result = $response->body();
//                $regex = "~\{(?:[^{}]|(?R))*\}~";
//                preg_match_all($regex, $result, $matches, PREG_OFFSET_CAPTURE);
//                dd($matches[0][15][0]);
            } else {
                $result = $response->body();
                throw new \Exception($result);
            }
        } catch (\Exception $e) {
            $result = $e->getMessage();
        }
    }
}
