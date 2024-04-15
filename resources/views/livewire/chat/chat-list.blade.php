<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="chatlist_header">
            <div class="title">
                Chat
            </div>
            <div class="img_container">
                <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{auth()->user()->name}}" alt="">
            </div>
    </div>

    <div class="chatlist_body">
        @if(count($conversations) > 0)
        @foreach($conversations as $conversation)
        <div class="chatlist_itens" wire:key="{{$conversation->id}}" wire:click="probando({{$conversation}}, {{$this->getChatUserInstance($conversation, $nombre = 'id')}})">
            <div class="chatlist_img_container">
                <img src="https://ui-avatars.com/api/?name={{$this->getChatUserInstance($conversation, $nombre = 'name')}}" alt="">
            </div>

            <div class="chatlist_info">
                <div class="top_row">
                    <div class="list_username">{{ $this->getChatUserInstance($conversation, $nombre='name') }}</div>
                    <span class="date">{{ $conversation->mensajes->last()?->created_at->shortAbsoluteDiffForHumans()}}</span>
                </div>
                <div class="botton_row">
                    <div class="mensaje_body text-truncate">
                        {{ $conversation->mensajes->last()->body}}
                    </div>

                    @php
                            if(count($conversation->mensajes->where('read',0)->where('receptor_id',Auth()->user()->id))){

                             echo ' <div class="unread_count badge rounded-pill text-light bg-danger">  '
                                 . count($conversation->mensajes->where('read',0)->where('receptor_id',Auth()->user()->id)) .'</div> ';

                            }

                    @endphp

                </div>
            </div>
        </div>
        @endforeach

        @else
            No Conversation
        @endif
    </div>
</div>
