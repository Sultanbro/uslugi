<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Laraketai\Mobizon\MobizonChannel;
use Laraketai\Mobizon\MobizonMessage;

class SmsNotification extends Notification
{
    use Queueable;

    public $text;

    /**
     * Create a new notification instance.
     */
    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return [MobizonChannel::class];
    }

    public function toMobizon($notifiable)
    {
        return MobizonMessage::create("Task #{$notifiable->id} is complete!");
    }
}
