@component('mail::message')
# Logare cu succes

@component('mail::panel')
<div style="width:100%; text-align:center; font-size:30px; font-height:bold;">
Salutare {{$message->name}}
</div>
Ai fost logat cu succes! <br>


@endcomponent

Multumim,<br>
Echipa Medic inlocuitor
@endcomponent
