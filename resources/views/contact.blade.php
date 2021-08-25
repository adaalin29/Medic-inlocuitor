@extends('parts.template') @section('content')
<div class="container">
    <div class="pagini">
        <a href="" class="pagini-link">Acasa |</a>
        <a href="contact" class="pagini-link">Contact</a>
    </div>
    <div class="contact-container">
        <form class="contact-form" action='{{ action("ContactController@send_message") }}' method="post">
            {{ csrf_field() }}
            <div class="index-beneficii-titlu">Contact</div>
            <input class="contact-input" type="text" id="fname" name="name" placeholder="Nume">
            <input class="contact-input" type="email" id="fname" name="email" placeholder="Adresa email">
            <input class="contact-input" type="number" id="fname" name="phone" placeholder="Telefon">
            <input class="contact-input" type="text" id="fname" name="message" placeholder="Mesaj">
            <div class="form-terms-contact">
                <label class="checkbox">
                    <input type="checkbox" id="accept-privacy" name="termeni" value="termeni">
                    <span></span>
                    <div class="form-terms-text-contact">Da, sunt de acord cu politica de confidentialitate.</div>
                </label>
            </div>
           <div class = "buton-container">
            <button class="create-account-blue" type="submit" id="buton-doctor">Trimite</button>
           </div>
        </form>
        <div class="contact-right">
            <div class="contact-right-inside">
                <div class="contact-text">{{setting('contact.nume')}}</div>
                <div class="contact-text contact-margin-bottom">{{setting('contact.cod')}}</div>
                <div class="contact-text">{!!setting('contact.adresa')!!}</div>
                <a href="tel:{{setting('contact.telefon')}}" class="contact-text">Tel:
                    {!!setting('contact.telefon')!!}</a>
                <a href="mailto:{{setting('contact.email')}}" class="contact-text">E-mail:
                    {!!setting('contact.email')!!}</a>
            </div>
        </div>
    </div>
    <div class = "map-container">
        <div id="map-canvas" onclick="mapsSelector()" style="height:100%;"></div>
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
   var $formContact = $('.contact-form');
   $('.create-account-blue').on('click', function (event) {
     event.preventDefault();
     $.ajax({
       method: 'POST',
       url: '{{ action("ContactController@send_message") }}',
       data: $formContact.serializeArray(),
       context: this,
       async: true,
       cache: false,
       dataType: 'json'
     }).done(function (res) {
       console.log(res);
       if (res.success == true) {
         $.notify(res.successMessage, "success");
         setTimeout(function () {
           window.location.reload();
         
         }, 4000);
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

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCmM1P-D5Zka0kPEbZSrsR90gpBlDxgm18"></script>
<script>
  function initialize() {

    // 				var geocoder;

    //         var address = "{{setting('site.adresa')}}";

    // # Get marker data

    var defaultMarkerLat = "{{setting('contact.latitude')}}";

    var defaultMarkerLng = "{{setting('contact.longitude')}}";

    var markerImg = '../images/marker.png';

    var markerTitle = "{{setting('site.title')}}";



    // # Show map

    var myLatlng = new google.maps.LatLng(defaultMarkerLat, defaultMarkerLng);

    var mapOptions = {

      zoom: 15,

      center: myLatlng,

      scrollwheel: false,

      mapTypeId: google.maps.MapTypeId.ROADMAP,

      disableDefaultUI: true

    }

    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    // # Show marker

    var marker = new google.maps.Marker({



      position: myLatlng,

      map: map,

      // 					icon:{markerImg} ,
      icon: {
        url: "images/marker.png",
        scaledSize: new google.maps.Size(48, 48)
      },

      title: markerTitle
    });

  }


  google.maps.event.addDomListener(window, 'load', initialize);
  function mapsSelector() {
  if /* if we're on iOS, open in Apple Maps */
    ((navigator.platform.indexOf("iPhone") != -1) || 
     (navigator.platform.indexOf("iPad") != -1) || 
     (navigator.platform.indexOf("iPod") != -1))
     window.open("http://maps.apple.com/?ll={{setting('contact.latitude')}},{{setting('contact.longitude')}}");
//      window.open("https://maps.google.com/maps?daddr={{setting('contact.latitude')}},{{setting('contact.longitude')}}&amp;ll=");
else /* else use Google */
    window.open("https://maps.google.com/maps?daddr={{setting('contact.latitude')}},{{setting('contact.longitude')}}&amp;ll=");
}
</script>

@endpush