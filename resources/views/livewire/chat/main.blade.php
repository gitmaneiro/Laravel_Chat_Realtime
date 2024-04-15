<div>
    <div class="chat_container">
        <div class="chat_list_container">
            @livewire('Chat.chat-list') 
        </div>
        <div class="chat_box_container">
            @livewire('Chat.chatbox')

            @livewire('Chat.send-mensaje')
        </div>
    </div>

</div>
@section('scripts')
<script>
    window.addEventListener('scrollBody', (event) => { 
        $('.chatbox_body').scrollTop( $('.chatbox_body')[0].scrollHeight);    
    });
 

    window.addEventListener('chatAbajo', (event) => {
        $('.chatbox_body').scrollTop( $('.chatbox_body')[0].scrollHeight);
        console.log('scroll abajo....');         
    });

    window.addEventListener('marcarMensajeLeido', (event) => {
        let value= document.querySelectorAll('.status_tick');
        
            value.foreach((elemento)=>{
                elemento.classList.remove("bi bi-check2");
                elemento.classList.add("bi bi-check2-all", "text-primary");
            });
        
                
    });    
</script>
@endsection


