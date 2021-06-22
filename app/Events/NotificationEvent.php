<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
  
    public function __construct($message)
    {
        $this->message = $message;
    }
  
    public function broadcastOn()
    {
        $user = \App\Models\User::find($this->message['id']);
        //sendFcm($user->fcm_token, "Notificación", $this->message['msg'],null);
        return ['user-'.$this->message['id'].'-channel'];
    }
  
    public function broadcastAs()
    {
        return $this->message['event'];
    }
}
