@extends('parts.template') @section('content')
<div class="container no-padding-mobile">
    <div class="header-banner">
        <div class="index-banner-text" data-aos="fade-up" data-aos-delay="100">
            <div class="index-banenr-title">{!!setting('index.banner-titlu')!!}</div>
            <div class="index-banenr-subtitle">{{setting('index.banner-subtitlu')}}</div>
            <a href="despre" class="buton-albastru">Afla mai multe</a>
        </div>
        <div class = "girl" data-aos="fade-left" data-aos-delay="500"><img src = "images/banner-girl.png" class = "girl-image"></div>
    </div>
</div>
<div class="index-conturi">
    <div class="index-conturi-left" data-aos="fade-right" data-aos-delay="100">
        <form class="index-form" id="formular-doctor" action='{{ action("AccountController@register") }}' method="post">
           {{ csrf_field() }}
            <div class="index-form-inside">
                <div class="index-form-titlu">Creaza-ti un cont de <span>Doctor</span>!</div>
                <input style="display:none;" type="number" name="id_type" value="1">
                <div class="index-input-element">
                    <input class="index-input" type="text" id="fname" name="name" placeholder="Nume">
                </div>
                <div class="index-input-element">
                    <input class="index-input" type="email" id="fname" name="email" placeholder="Email">
                </div>
                <div class="index-input-element">
                    <input class="index-input" type="password" id="fname" name="password" placeholder="Parola">
                </div>
               <div class="index-input-element">
                    <input class="index-input" type="password" id="fname" name="confirm_password" placeholder="Confirmare parola">
                </div>
                <div class="form-terms">
                    <label class="checkbox">
                        <input type="checkbox" id="accept-privacy" name="termeni" value="termeni">
                        <span></span>
                        <div class="form-terms-text">Da, sunt de acord ca datele mele sa fie salvate pentru a-mi creea un
                            cont.</div>
                    </label>
                </div>
                <div class="buton-container">
                    <button class="create-account-red" type="submit" id="buton-index-doctor">Creaza cont</button>
                </div>
                <div class="deja-cont" id="deja-cont-doctor">Am deja cont. <div class="login-div" id = "index-login-medic">Log in.</div>
                </div>
            </div>
        </form>
    </div>
    <div class="index-conturi-right" data-aos="fade-left" data-aos-delay="200">
        <form class="index-form" id="formular-rezident" action='{{ action("AccountController@register") }}' method="post">
           {{ csrf_field() }}
            <div class="index-form-inside">
                <div class="index-form-titlu">Creaza-ti un cont de <span>Rezident</span>!</div>
                <input style="display:none;" type="number" name="id_type" value="2">
                <div class="index-input-element">
                    <input class="index-input" type="text" id="fname" name="name" placeholder="Nume">
                </div>
                <div class="index-input-element">
                    <input class="index-input" type="email" id="fname" name="email" placeholder="Email">
                </div>
                <div class="index-input-element">
                    <input class="index-input" type="password" id="fname" name="password" placeholder="Parola">
                </div>
                <div class="index-input-element">
                    <input class="index-input" type="password" id="fname" name="confirm_password" placeholder="Confirmare parola">
                </div>
                <div class="form-terms">
                    <label class="checkbox">
                        <input type="checkbox" id="accept-privacy" name="termeni" value="termeni">
                        <span></span>
                        <div class="form-terms-text">Da, sunt de acord ca datele mele sa fie salvate pentru a-mi creea un
                            cont.</div>
                    </label>
                </div>
                <div class="buton-container">
                    <button class="create-account-red" type="submit" id="buton-index-rezident">Creaza cont</button>
                </div>
                <div class="deja-cont" id="deja-cont-rezident">Am deja cont. <div class="login-div" id = "index-login-rezident">Log in.</div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="container">
    <div class="index-servicii">
        <div class="index-serviciu" data-aos="fade-left" data-aos-delay="100">
            <div class="index-serviciu-image"><img src="images/index-serviciu1.svg" class="width"></div>
            <div class="index-serviciu-title">{{setting('index.serviciu1-titlu')}}</div>
            <div class="index-serviciu-text">{{setting('index.serviciu1-descriere')}}</div>
        </div>
        <div class="index-serviciu" data-aos="fade-left" data-aos-delay="200">
            <div class="index-serviciu-image"><img src="images/index-serviciu2.svg" class="width"></div>
            <div class="index-serviciu-title">{{setting('index.serviciu2-titlu')}}</div>
            <div class="index-serviciu-text">{{setting('index.serviciu2-descriere')}}</div>
        </div>
        <div class="index-serviciu" data-aos="fade-left" data-aos-delay="300">
            <div class="index-serviciu-image"><img src="images/index-serviciu3.svg" class="width"></div>
            <div class="index-serviciu-title">{{setting('index.serviciu3-titlu')}}</div>
            <div class="index-serviciu-text">{{setting('index.serviciu3-descriere')}}</div>
        </div>
        <div class="index-serviciu" data-aos="fade-left" data-aos-delay="400">
            <div class="index-serviciu-image"><img src="images/index-serviciu4.svg" class="width"></div>
            <div class="index-serviciu-title">{{setting('index.serviciu4-titlu')}}</div>
            <div class="index-serviciu-text">{{setting('index.serviciu4-descriere')}}</div>
        </div>
    </div>
    <div class="index-about">
        <div class="index-about-left" data-aos="fade-up" data-aos-delay="200">
            <div class="index-about-title">{{setting('index.serviciu-titlu')}}</div>
            <div class="index-about-descriere">{{setting('index.serviciu-descriere')}}</div>
            <a href="despre" class="buton-albastru">Afla mai multe</a>
        </div>
        <div class="index-about-right">
            <img src="{{ route('thumb', ['width:600', setting('index.serviciu-imagine')]) }}" class="full-width">
        </div>
    </div>
    <div class="index-beneficii">
        <div class="index-beneficii-left">
            <div class="index-beneficiu" data-aos="fade-right" data-aos-delay="100">
                <div class = "index-beneficiu-imagine">
                    <img src = "images/index-beneficiu1.svg" class = "width">
                    <img src = "images/index-beneficiu1-white.svg" class = "width white-image">
                </div>
                <div class="index-beneficiu-titlu">{{setting('index.beneficiu1-titlu')}}</div>
                <div class="index-beneficiu-descriere">{{setting('index.beneficiu1-descriere')}}</div>
            </div>
            <div class="index-beneficiu" data-aos="fade-right" data-aos-delay="200">
                <div class = "index-beneficiu-imagine">
                    <img src = "images/index-beneficiu2.svg" class = "width">
                    <img src = "images/index-beneficiu2-white.svg" class = "width white-image">
                </div>
                <div class="index-beneficiu-titlu">{{setting('index.beneficiu2-titlu')}}</div>
                <div class="index-beneficiu-descriere">{{setting('index.beneficiu2-descriere')}}</div>
            </div>
            <div class="index-beneficiu" data-aos="fade-right" data-aos-delay="300">
                <div class = "index-beneficiu-imagine">
                    <img src = "images/index-beneficiu3.svg" class = "width">
                    <img src = "images/index-beneficiu3-white.svg" class = "width white-image">
                </div>
                <div class="index-beneficiu-titlu">{{setting('index.beneficiu3-titlu')}}</div>
                <div class="index-beneficiu-descriere">{{setting('index.beneficiu3-descriere')}}</div>
            </div>
            <div class="index-beneficiu" data-aos="fade-right" data-aos-delay="400">
                <div class = "index-beneficiu-imagine">
                    <img src = "images/index-beneficiu4.svg" class = "width">
                    <img src = "images/index-beneficiu4-white.svg" class = "width white-image">
                </div>
                <div class="index-beneficiu-titlu">{{setting('index.beneficiu4-titlu')}}</div>
                <div class="index-beneficiu-descriere">{{setting('index.beneficiu4-descriere')}}</div>
            </div>
        </div>
        <div class="index-beneficii-right">
            <div class = "index-beneficii-titlu">{{setting('index.beneficii-titlu')}}</div>
            <div class = "index-beneficii-descriere">{{setting('index.beneficii-descriere')}}</div>
            <a href="despre" class="buton-albastru">Afla mai multe</a>
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
    var $formContact = $('#formular-doctor');
    $('#buton-index-doctor').on('click', function (event) {
      event.preventDefault();
      $.ajax({
        method: 'POST',
        url: '{{ action("AccountController@register") }}',
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
<script>
  document.addEventListener("DOMContentLoaded", function () {
    $.ajaxSetup({

      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    var $formContact = $('#formular-rezident');
    $('#buton-index-rezident').on('click', function (event) {
      event.preventDefault();
      $.ajax({
        method: 'POST',
        url: '{{ action("AccountController@register") }}',
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