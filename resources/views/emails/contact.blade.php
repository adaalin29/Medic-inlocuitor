@component('mail::message')
# Aveti un mesaj nou

@component('mail::panel')
<div style="width:100%; text-align:center; font-size:30px; font-height:bold;">
Mesaj nou
</div>

Nume: {{$message['name']}}<br>
Telefon: {{$message['phone']}}<br>
Email: {{$message['email']}}<br>
Mesaj: {{$message['message']}}<br>


@endcomponent

Multumim,<br>
Echipa Medic inlocuitor
@endcomponent
