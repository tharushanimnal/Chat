<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NewMessageNotification extends Notification {
    use Queueable;

    public function __construct(public $sender) {}

    public function via($notifiable) {
        return ['database'];
    }

    public function toDatabase($notifiable): array {
        return [
            'message' => 'New message from ' . $this->sender->name,
            'sender_id' => $this->sender->id
        ];
    }
}
