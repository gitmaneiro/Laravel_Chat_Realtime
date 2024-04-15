<div>
    @if($seleccionarConversation)
    <form wire:submit.prevent="enviarMensaje">
        <div class="chatbox_footer">
            <div class="custom_form_group">
                <input type="text" wire:model="body" class="control" placeholder="Write message">
                <button type="submit" class="submit">send</button>
            </div>
        </div>
    </form>
    @endif
</div>
