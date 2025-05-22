<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NewMessageNotification extends Notification
{
    protected $sender;
    protected $message;

    public function __construct($sender, $message)
    {
        $this->sender = $sender;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'sender_id' => $this->sender->id,
            'sender_name' => $this->sender->name,
            'message_id' => $this->message->id,
            'content' => $this->message->content,
        ];
    }
}

