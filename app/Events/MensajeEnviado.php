<?php

namespace App\Events;

use App\Models\Conversacion;
use App\Models\Mensaje;
use App\Models\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MensajeEnviado implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $mensaje;
    public $conversation;
    public $receptor;

    public function __construct(User $user, Mensaje $message, Conversacion $conversation, User $receptor)
    {
        $this->user= $user;
        $this->mensaje= $message;
        $this->conversation= $conversation;
        $this->receptor= $receptor;
        
    }


    public function broadcastWith():array
    {

        return [
             'user_id'=>$this->user->id,
             'mensaje'=>$this->mensaje->id,
             'conversation_id'=>$this->conversation->id,
             'receptor_id'=>$this->receptor->id,
        ];
      
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn():array
    {
        return [  
         new Channel('chat_livewire'),
        ];
    }
}
