<?php

namespace App\Livewire\Chat;

use Livewire\Attributes\On;
use App\Models\Conversacion;
use App\Models\User;
use App\Models\Mensaje;
use App\Events\MensajeEnviado;
use App\Events\MensajeLeido;

use Livewire\Component;

class Chatbox extends Component
{

    public $seleccionarConversation;
    public $receptorInstance;
    public $mensajes_count;
    public $paginateVar= 10;
    public $mensajes;
    
  
    public function getListeners()
    {
       
       
        return [
            "echo:chat_livewire,MensajeEnviado" => 'broadcastedMensajeRecivido',
            "echo:chat_livewire,MensajeLeido" => 'broadcastedMensajeLeido',
            'cargarConversacion', 'empujarMensaje',
        ];
    }

    public function broadcastedMensajeRecivido($event)
    {
        //dd($event);
        $this->dispatch('refreshChatList');
        
        $broadcastMensaje= Mensaje::find($event['mensaje']);

        if($this->seleccionarConversation){

            if ((int) $this->seleccionarConversation->id  === (int)$event['conversation_id']) {
                    //dd('mensaje recivido...');
                    $broadcastMensaje->read=1;
                    $broadcastMensaje->save();

                    $this->empujarMensaje($broadcastMensaje->id);
                    $this->dispatch('disparaMensajeLeido');
                    
            }

        }

    }

    #[On('disparaMensajeLeido')]
    public function disparaMensajeLeido()
    {
        MensajeLeido::dispatch($this->seleccionarConversation->id, $this->receptorInstance->id);
        //dd('Evento mensaje leido....');
    }

    public function broadcastedMensajeLeido($event)
    {
        if($this->seleccionarConversation){

            if((int) $this->seleccionarConversation->id === (int) $event['conversation_id']){

                $this->dispatch('marcarMensajeLeido');
            }
        }
    }
    

    #[On('cargarConversacion')]
    public function cargarConversacion(Conversacion $seleccionarConversation, User $receptorInstance){
        //dd($receptorInstance);
        $this->seleccionarConversation= $seleccionarConversation;
        $this->receptorInstance= $receptorInstance;

        $this->mensajes_count=  Mensaje::where('conversacion_id', $this->seleccionarConversation->id)->count();

        $this->mensajes=  Mensaje::where('conversacion_id',  $this->seleccionarConversation->id)
        ->skip($this->mensajes_count -  $this->paginateVar)
        ->take($this->paginateVar)->get();
        
    }

    #[On('empujarMensaje')]
    public function empujarMensaje($mensajeId){
        //dd($mensajeId);
        $nuevoMensaje= Mensaje::find($mensajeId);
        $this->mensajes->push($nuevoMensaje);
        $this->dispatch('chatAbajo');
    }

    public function render()
    {
        return view('livewire.chat.chatbox');
    }
}
