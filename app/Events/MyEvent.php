<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    // public function broadcastOn()
    // {
    //     return ['my-channel'];
    // }

    public function broadcastAs()
    {
        return 'my-event';
    }


    public function broadcastOn()
    {
        info($this->message);
  
        return [
            new PrivateChannel('chat.' . $this->message['receiver_id']),
            new PrivateChannel('chat.' . $this->message['userIds'])
        
        ];
    }
}
