<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MensajeLeido implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

   
    public $conversation_id;
    public $receptor_id;

    public function __construct($conversation_id, $receptor_id)
    {
        $this->conversation_id= $conversation_id;
        $this->receptor_id= $receptor_id;
    }



    public function broadcastWith():array
    {

        return [
             'conversation_id'=>$this->conversation_id,
             'receptor_id'=>$this->receptor_id,
        ];
      
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('chat_livewire'),
        ];
    }
}
