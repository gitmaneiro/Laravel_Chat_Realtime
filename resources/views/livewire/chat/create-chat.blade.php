<div>
 
    <ul class="list-group w-75 mx-auto mt-3 container-fluid">
        @foreach($users as $user)
            <li class="list-group-item list-group-item-action mb-2" wire:click="checkcorversation({{$user->id}})">
                {{$user->name}}
            </li>
        @endforeach
    </ul>



</div>
