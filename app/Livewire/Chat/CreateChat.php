<?php

namespace App\Livewire\Chat;
use App\Models\User;
use App\Models\Conversacion;
use App\Models\Mensaje;


use Livewire\Component;

class CreateChat extends Component
{

    public $users;
    public $message= 'hello how are you';

    public function checkcorversation($receiverId){
        //dd($receiverId);

        $checkedConversation= Conversacion::where('receptor_id', auth()->user()->id)->where('remitente_id', $receiverId)->orWhere('receptor_id', $receiverId)->where('remitente_id', auth()->user()->id)->get();


        if(count($checkedConversation)==0){
           
            $createdConversation= Conversacion::create(['receptor_id'=>$receiverId,'remitente_id'=>auth()->user()->id,'last_time_message'=>0]);

            $createdMessage= Mensaje::create(['conversacion_id'=>$createdConversation->id,'remitente_id'=>auth()->user()->id,'receptor_id'=>$receiverId,'body'=>$this->message]);

            $createdConversation->last_time_message= $createdMessage->created_at;
            $createdConversation->save();
            dd('save');

        }else if(count($checkedConversation)>=1){
            dd('Conversation exists...');



        }

    }

    public function render()
    {

        $this->users= User::where('id', '!=', auth()->user()->id)->get();
        return view('livewire.chat.create-chat');
    }
}
