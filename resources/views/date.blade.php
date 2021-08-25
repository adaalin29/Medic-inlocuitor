@extends('parts.template') @section('content')
<div class="container">
    <a href="cont" class="return-cont">
        <img src="images/right.svg" class="sageata">
        <div class="return-text">Date personale</div>
    </a>
    <div class="descriere">Completeaza datele tale personale pentru a beneficia de serviciile oferite de Medic
        Inlocuitor.</div>
    <form class="edit-cont" id = "edit-account">
        {{ csrf_field() }}
        <div class="cont-container-formular">
            <div class="edit-element">
                <input class="contact-input edit-input" type="text" name="cont_name" placeholder="Nume si preunme">
            </div>
            <div class="edit-element">
                <input class="contact-input edit-input" type="number" name="cont_telefon" placeholder="Telefon">
            </div>
            <div class="edit-element">
                <input class="contact-input edit-input" type="email" name="cont_email" placeholder="Email">
            </div>
            <div class="edit-element">
                <input class="contact-input edit-input" type="text" name="cont_parafa" placeholder="Cod parafa">
            </div>
            <div class="edit-element">
                <div class="edit-arrow"><img src="images/sageata.svg" class="width"></div>
                <select id="specializare" name="cont_specializare">
                    @foreach($specializari as $specializare)
                    <option class="option-da" value="{{$specializare->id}}">{{$specializare->nume}}</option>
                    @endforeach
                </select>
            </div>
            <div class="edit-element">
                <div class="edit-arrow"><img src="images/sageata.svg" class="width"></div>
                <select id="titulatura" name="cont_titulatura">
                    @foreach($titlulatura as $titulatura)
                    <option value="{{$titulatura->id}}">{{$titulatura->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="edit-element">
                <div class="edit-arrow"><img src="images/sageata.svg" class="width"></div>
                <select id="titulatura" name="cont_pacienti">
                    @foreach($tipPacienti as $tip)
                    <option value="{{$tip->id}}">{{$tip->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="edit-element">
                <input class="contact-input edit-input" type="text" name="cont_locatie" placeholder="Locatie cabinet/loc de munca">
            </div>
            <div class="edit-element">
                <div class="edit-arrow"><img src="images/sageata.svg" class="width"></div>
                <select id="titulatura" name="cont_judet">
                    @foreach($judete as $judet)
                    <option value="{{$judet->id}}">{{$judet->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="edit-element-modificat">
                <input class="contact-input edit-input" type="text" name="cont_informatii" placeholder="Preferinte si sugestii">
            </div>
            <div class="edit-element">
                <div class="edit-arrow"><img src="images/lock.svg" class="width"></div>
                <input class="contact-input edit-input" type="password" name="cont_password" placeholder="Parola">
            </div>
        </div>
        <div class="form-terms-cont form-terms-date">
            <label class="checkbox">
                <input type="checkbox" id="accept-privacy" name="cont_termeni" value="termeni">
                <span></span>
            </label>
            <div class="form-terms-text-contact">Da, sunt de acord cu politica de confidentialitate.</div>
        </div>
        <div class = "buton-container">
            <button class="create-account-blue" id = "date-buton" type="submit">Salveaza</button>
            <div class="create-account-red" id = "sterge-cont" type="submit">Sterge cont</div>
           </div>
    </form>
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
   var $formContact = $('#edit-account');
   $('#date-buton').on('click', function (event) {
     event.preventDefault();
     $.ajax({
       method: 'POST',
       url: '{{ action("AccountController@edit_cont") }}',
       data: $formContact.serializeArray(),
       context: this,
       async: true,
       cache: false,
       dataType: 'json'
     }).done(function (res) {
       console.log(res);
       if (res.success == true) {
         $.notify(res.error, "success");
         setTimeout(function () {
            window.location.reload();
          
          }, 2000);
       } else {
         var eroare = res.error;
       for (var i = 0; i < eroare.length; i++) {
         eroare[i] = eroare[i] + "\n";
       }
         $.notify(res.error, {
           type: "error",
           breakNewLines: true,
           gap:2
         });
       }
     });
     return;
   });

 });
</script>
@endpush