<div>

    @if($seleccionarConversation)
    <div class="chatbox_header">
        <div class="return">
            <i class="bi bi-arrow-left"></i>
        </div>
        <div class="box_img_container">
            <img src="https://ui-avatars.com/api/?name={{$receptorInstance->name}}" alt="">
        </div>
        <div class="name">
            {{$receptorInstance->name}}
        </div>
        <div class="info">
            <div class="item_info">
                <i class="bi bi-telephone-fill"></i>
            </div>
            <div class="item_info">
                <i class="bi bi-image"></i>
            </div>
            <div class="item_info">
                <i class="bi bi-info-circle-fill"></i>
            </div>
        </div>
    </div>
    <div class="chatbox_body">


        @foreach($mensajes as $mensaje)
        <div class="mensaje_body {{ auth()->id() == $mensaje->remitente_id ? 'mensaje_body_me' : 'mensaje_body_receiver' }}">
        
            {{$mensaje->body}}

            <div class="menj_body_footer">
                <div class="date">
                    {{$mensaje->created_at->format('m. i a')}}
                </div>
                <div class="read">
                    @php
                        if($mensaje->user->id == auth()->id()){
                            if($mensaje->read==0){
                                echo '<i class="bi bi-check2 status_tick "></i> ';
                            }else{
                                echo '<i class="bi bi-check2-all text-primary  "></i>';
                            }
                        }
                    @endphp
                   
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
        <div class="fs-4 text-center text-primary mt-5 no_conversation">
        
            <img src="{{URL::asset('image/team_chat.svg')}}" class="img_noconversation">
        </div>
    @endif

</div>

