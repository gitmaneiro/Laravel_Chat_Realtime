<?php

namespace App\Livewire\Chat;

use App\Events\MensajeEnviado;
use Livewire\Attributes\On;
use App\Models\Conversacion;
use App\Models\User;
use App\Models\Mensaje;

use Livewire\Component;

class SendMensaje extends Component
{

    public $seleccionarConversation;
    public $receptorInstance;
    public $body='';
    public $crearMensaje;


   

    #[On('actualizarEnvio')]
    public function actualizarEnvio(Conversacion $seleccionarConversation, User $receptorInstance){
        $this->seleccionarConversation= $seleccionarConversation;
        $this->receptorInstance= $receptorInstance;

    }

    public function resetBody(){
        $this->body ='';
    }

    public function enviarMensaje(){
        //dd($this->body);
        if($this->body == null){
            return null;
        }

        $this->crearMensaje=  Mensaje::create([
            'conversacion_id' => $this->seleccionarConversation->id,
            'remitente_id' => auth()->id(),
            'receptor_id' => $this->receptorInstance->id,
            'body' => $this->body,

        ]);

        $this->seleccionarConversation->last_time_message = $this->crearMensaje->created_at;
        $this->seleccionarConversation->save();

        $this->dispatch('empujarMensaje',  $this->crearMensaje->id);
        $this->dispatch('refreshChatList');
        MensajeEnviado::dispatch(Auth()->user(), $this->crearMensaje, $this->seleccionarConversation, $this->receptorInstance);
        $this->resetBody();    
      
        

    }

   

   
    public function render()
    {
        return view('livewire.chat.send-mensaje');
    }
}
