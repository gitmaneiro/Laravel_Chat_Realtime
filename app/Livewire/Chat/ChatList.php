<?php

namespace App\Livewire\Chat;
use Livewire\Attributes\On;
use App\Models\Conversacion;
use App\Models\User;
use Livewire\Component;


class ChatList extends Component
{
    public $auth_id;
    public $conversations;
    public $receptorInstance;
    public $nombre;
    public $seleccionarConversation;

    
    public function probando(Conversacion $conversation, $receptorId){

        $this->seleccionarConversation= $conversation;
        $receptorInstance= User::find($receptorId);
        //dd($receptorInstance);
        $this->dispatch('cargarConversacion',  $this->seleccionarConversation, $receptorInstance);
        $this->dispatch('actualizarEnvio',  $this->seleccionarConversation, $receptorInstance);
        $this->dispatch('scrollBody');
    }



    public function getChatUserInstance(Conversacion $conversation, $request){
        $this->auth_id = auth()->id();

        if ($conversation->remitente_id == $this->auth_id) {
            $this->receptorInstance = User::firstWhere('id', $conversation->receptor_id);
            # code...
        } else {
            $this->receptorInstance = User::firstWhere('id', $conversation->remitente_id);
        }

        if (isset($request)) {

            return $this->receptorInstance->$request;
            # code...
        }



    }

    #[On('refreshChatList')]
    public function refreshChatList(){

    }

    public function mount(){

        $this->auth_id=auth()->id();
        $this->conversations= Conversacion::where('remitente_id', $this->auth_id)->orWhere('receptor_id', $this->auth_id)->orderBy('last_time_message', 'DESC')->get();
    }

    public function render()
    {
        return view('livewire.chat.chat-list');
    }
}
