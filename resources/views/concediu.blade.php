@extends('parts.template') @section('content')
<div class = "container">
  <a href="cont" class="return-cont">
        <img src="images/right.svg" class="sageata">
        <div class="return-text">Calendar program</div>
    </a>
   <div class="descriere">Alege in ce perioada esti in concediu si ai nevoie de un inlocuitor.</div>
  <div class = "calendar-container">
    <div class ="calendar-left">
     <div class = "calendar-left-inside">
        <div id = "calendar"  class = "datepicker-here"  data-range="true" data-multiple-dates-separator=" - " ></div>
        <div class = "cont-buton-rosu concediu-buton" id = "calendar-buton">Urmatorul pas</div>
      </div>
       <div class = "calendar-left-inside-ora">
        <div class = "calendar-ora">
          <div class = "ora-background"> <img src = "images/ora-background.svg" class = "full-width"></div>
          <div class = "ora-person"><img src = "images/ora-person.svg" class = "width"></div>
          <form class = "ora-elemente" action='{{ action("AccountController@concediu_medic") }}' method="post">
           {{ csrf_field() }}
          <input type = "hidden"  name = "name" value = "{{$user->name}}">
          <input type = "hidden"  name = "email" value = "{{$user->email}}">
          <input type = "hidden"  name = "phone" value = "{{$user->telefon}}">
          <input type = "hidden"  name = "locatie" value = "{{$user->locatie}}">
            <div class="edit-ora">
                <input type = "text" style = "display:none;" name = "concediu_date" id = "date">
                <div class="edit-arrow"><img src="images/clock.svg" class="width"></div>
                <select id="titulatura" name="start_hour">
                   <option value="8:00">8:00</option>
                  <option value="8:30">8:30</option>
                  <option value="9:00">9:00</option>
                  <option value="9:30">9:30</option>
                  <option value="10:00">10:00</option>
                  <option value="10:30">10:30</option>
                  <option value="11:00">11:00</option>
                  <option value="11:30">11:30</option>
                  <option value="12:00">12:00</option>
                  <option value="12:30">12:30</option>
                  <option value="13:00">13:00</option>
                  <option value="13:30">13:30</option>
                  <option value="14:00">14:00</option>
                  <option value="14:30">14:30</option>
                  <option value="15:00">15:00</option>
                  <option value="15:30">15:30</option>
                  <option value="16:00">16:00</option>
                  <option value="16:30">16:30</option>
                  <option value="17:00">17:00</option>
                  <option value="17:30">17:30</option>
                  <option value="18:00">18:00</option>
                  <option value="18:30">18:30</option>
                  <option value="19:00">19:00</option>
                  <option value="19:30">19:30</option>
                  <option value="20:00">20:00</option>
                  <option value="20:30">20:30</option>
                  <option value="21:00">21:00</option>
                  <option value="21:30">21:30</option>
                  <option value="22:00">22:00</option>
                  <option value="22:30">22:30</option>
                  <option value="23:00">23:00</option>
                  <option value="23:30">23:30</option>
                  <option value="00:00">00:00</option>
              </select>
            </div> 
            <div class="edit-ora">
                <div class="edit-arrow"><img src="images/clock.svg" class="width"></div>
                <select id="titulatura" name="end_hour">
                  <option value="8:00">8:00</option>
                  <option value="8:30">8:30</option>
                  <option value="9:00">9:00</option>
                  <option value="9:30">9:30</option>
                  <option value="10:00">10:00</option>
                  <option value="10:30">10:30</option>
                  <option value="11:00">11:00</option>
                  <option value="11:30">11:30</option>
                  <option value="12:00">12:00</option>
                  <option value="12:30">12:30</option>
                  <option value="13:00">13:00</option>
                  <option value="13:30">13:30</option>
                  <option value="14:00">14:00</option>
                  <option value="14:30">14:30</option>
                  <option value="15:00">15:00</option>
                  <option value="15:30">15:30</option>
                  <option value="16:00">16:00</option>
                  <option value="16:30">16:30</option>
                  <option value="17:00">17:00</option>
                  <option value="17:30">17:30</option>
                  <option value="18:00">18:00</option>
                  <option value="18:30">18:30</option>
                  <option value="19:00">19:00</option>
                  <option value="19:30">19:30</option>
                  <option value="20:00">20:00</option>
                  <option value="20:30">20:30</option>
                  <option value="21:00">21:00</option>
                  <option value="21:30">21:30</option>
                  <option value="22:00">22:00</option>
                  <option value="22:30">22:30</option>
                  <option value="23:00">23:00</option>
                  <option value="23:30">23:30</option>
                  <option value="00:00">00:00</option>
              </select>
            </div>
            <buton style = "display:none" type = "submit" id = "trimite-calendar"></buton>
          </form>
         </div>
        <div class = "cont-buton-rosu concediu-buton buton-trimite" >Salveaza</div>
      </div>
    </div>
    <div class ="calendar-right">
      <div class = "calendar-background"> <img src = "images/calendar-background.svg" class = "width"> </div>
      <div class = "calendar-person" data-aos="fade-right"  data-aos-delay="200"  data-aos-duration="600" ><img src = "images/calendar-person.svg" class = "width"> </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      $.ajaxSetup({

        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      var $formContact = $('.ora-elemente');
      $('#trimite-calendar').on('click', function (event) {
        event.preventDefault();
        $.ajax({
          method: 'POST',
          url: '{{ action("AccountController@concediu_medic") }}',
          data: $formContact.serializeArray(),
          context: this,
          async: true,
          cache: false,
          dataType: 'json'
        }).done(function (res) {
          console.log(res);
          if (res.success == true) {
            $.notify(res.msg, "success");
            setTimeout(function () {
              window.location.reload();

            }, 2000);
          } else {
            var eroare = res.msg;
            for (var i = 0; i < eroare.length; i++) {
              eroare[i] = eroare[i] + "\n";
            }
            $.notify(res.msg, {
              type: "error",
              breakNewLines: true,
              gap: 2
            });
          }
        });
        return;
      });

    });
  </script>
@endpush