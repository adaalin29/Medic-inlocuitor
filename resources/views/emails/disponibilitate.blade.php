@component('mail::message')
# Aveti un rezident disponibil nou

@component('mail::panel')
<div style="width:100%; text-align:center; font-size:30px; font-height:bold;">
Rezident disponibil:
</div>

Nume: {{$message['name']}}<br>
Perioada: {{$message['concediu_date']}}<br>
Telefon: {{$message['phone']}}<br>
Email: {{$message['email']}}<br>


@endcomponent

Multumim,<br>
Echipa Medic inlocuitor
@endcomponent
