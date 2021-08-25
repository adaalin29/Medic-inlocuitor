<!DOCTYPE html>
<html>

<head>
  <base href="{{ URL::to('/') }}" />
  <title>Medic inlocuitor</title>
  <meta charset="utf-8" />
  <meta name="description" content="@yield('description')" />
  <meta name="keywords" content="@yield('keywords')" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <!-- responsive use only -->
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <link href="css/responsive.css" rel="stylesheet" type="text/css" />
  <link href="css/aos.css" rel="stylesheet" type="text/css" />
  <link href="css/datepicker.min.css" rel="stylesheet" type="text/css" />
  @stack('styles')
</head>

<body>

  <div id="page">
    <div class="overlay">
      <div class="container formulare-container">
        {{-- formulare login --}}
        <form class="login" id="formular-cont-rezident">
          <div class="close-login"><img src="images/close-login.svg" class="width"></div>
          <div class="login-mobile-container">
            <div class="login-mobile-container-inside">
              <a href="" class="login-logo"><img src="images/logo.svg" class="width"></a>
              <div class="login-titlu">Login ca Rezident</div>
              <div class="login-subtitlu">Completeaza datele de logare si intra in contul tau.</div>
              <div class="cont-input-elemente">
                <input class="cont-input" type="email" name="email" placeholder="Email">
                <input class="cont-input" type="password" name="password" placeholder="Parola">
              </div>
              <div class="buton-container">
                <button class="create-account-red" type="submit" id="login-rezident">Log in</button>
              </div>
              <div class="forgot">Am uitat parola</div>
              <div class="lipsa-cont">Nu am cont. <div class="creeaza" id="creeaza-rezident">Creeaza un cont de Rezident
                </div>
              </div>
            </div>
          </div>
        </form>
        <form class="login" id="delete-account">
          <div class="close-login"><img src="images/close-login.svg" class="width"></div>
          <div class="login-mobile-container">
            <div class="login-mobile-container-inside">
              <a href="" class="login-logo"><img src="images/logo.svg" class="width"></a>
              <div class="login-titlu">Sterge cont</div>
              <div class="login-subtitlu">Esti sigur ca vrei sa stergi contul?</div>
              <div class="buton-container">
                <button class="create-account-red" id="btn-sterge">Sterge cont</button>
              </div>
              <div class="buton-container">
                <div class="create-account-red" id="renunta-stergere"
                  style="display:flex;align-items:center;justify-content:center">Renunta</div>
              </div>
            </div>
          </div>
      </form>
      <form class="login" id="formular-cont-medic">
        <div class="close-login"><img src="images/close-login.svg" class="width"></div>
        <div class="login-mobile-container">
          <div class="login-mobile-container-inside">
            <a href="" class="login-logo"><img src="images/logo.svg" class="width"></a>
            <div class="login-titlu">Login ca Medic</div>
            <div class="login-subtitlu">Completeaza datele de logare si intra in contul tau.</div>
            <div class="cont-input-elemente">
              <input class="cont-input" type="email" name="email" placeholder="Email">
              <input class="cont-input" type="password" name="password" placeholder="Parola">
            </div>
            <div class="buton-container">
              <button class="create-account-red" type="submit" id="login-medic">Log in</button>
            </div>

            <div class="forgot">Am uitat parola</div>
            <div class="lipsa-cont">Nu am cont. <div class="creeaza" id="creeaza-medic">Creeaza un cont de Medic</div>
            </div>
          </div>
        </div>
      </form>



      {{-- formulare register --}}
      <form class="login" id="creeaza-cont-medic">
        <div class="close-login"><img src="images/close-login.svg" class="width"></div>
        <div class="login-mobile-container">
          <div class="login-mobile-container-inside">
            <a href="" class="login-logo"><img src="images/logo.svg" class="width"></a>
            <div class="login-titlu">Creeaza cont Medic</div>
            <div class="login-subtitlu">Completeaza datele de inregistrare si intra in contul tau.</div>
            <div class="cont-input-elemente">

              <input class="cont-input" type="text" name="name" placeholder="Nume">
              <input style="display:none;" type="number" name="id_type" value="1">
              <input class="cont-input" type="email" name="email" placeholder="Email">
              <input class="cont-input" type="password" name="password" placeholder="Parola">
              <input class="cont-input" type="password" name="confirm_password" placeholder="Confirmare parola">
            </div>
            <div class="form-terms-cont">
              <label class="checkbox">
                <input type="checkbox" id="accept-privacy" name="termeni" value="termeni">
                <span></span>
              </label>
              <div class="form-terms-text-contact">Da, sunt de acord ca datele mele sa fie salvate pentru a-mi creea
                un
                cont.</div>
            </div>
            <div class="buton-container">
              <button class="create-account-red" type="submit" id="buton-medic">Inregistreaza-te</button>
            </div>
            <div class="am-cont">Am cont.<div class="logheaza" id="am-medic">Log in</div>
            </div>
          </div>
        </div>
      </form>
      <form class="login" id="creeaza-cont-rezident">
        <div class="close-login"><img src="images/close-login.svg" class="width"></div>
        <div class="login-mobile-container">
          <div class="login-mobile-container-inside">
            <a href="" class="login-logo"><img src="images/logo.svg" class="width"></a>
            <div class="login-titlu">Creeaza cont Rezident</div>
            <div class="login-subtitlu">Completeaza datele de inregistrare si intra in contul tau.</div>
            <div class="cont-input-elemente">
              <input style="display:none;" type="number" name="id_type" value="2">
              <input class="cont-input" type="text" name="name" placeholder="Nume">
              <input class="cont-input" type="email" name="email" placeholder="Email">
              <input class="cont-input" type="password" name="password" placeholder="Parola">
              <input class="cont-input" type="password" name="confirm_password" placeholder="Confirmare parola">
            </div>
            <div class="form-terms-cont">
              <label class="checkbox">
                <input type="checkbox" id="accept-privacy" name="termeni" value="termeni">
                <span></span>
              </label>
              <div class="form-terms-text-contact">Da, sunt de acord ca datele mele sa fie salvate pentru a-mi creea
                un
                cont.</div>
            </div>
            <div class="buton-container">
              <button class="create-account-red" type="submit" id="buton-rezident">Inregistreaza-te</button>
            </div>
            <div class="am-cont">Am cont.<div class="logheaza" id="am-rezident">Log in</div>
            </div>
          </div>
        </div>
      </form>
      {{-- formulare Resetare parola --}}
      <form class="login" id="reseteaza-parola" action='{{ action("AccountController@modifica_parola") }}'
        method="post">
        <div class="close-login"><img src="images/close-login.svg" class="width"></div>
        <div class="login-mobile-container">
          <div class="login-mobile-container-inside">
            <a href="" class="login-logo"><img src="images/logo.svg" class="width"></a>
            <div class="login-titlu">Reseteaza-ti parola</div>
            <div class="login-subtitlu">Introdu adresa de email</div>
            <div class="cont-input-elemente" id="modifica-parola-container">
              <input type="hidden" name="actiune_modificare" value="trimite_cod" />
              <input class="cont-input" type="email" name="email" placeholder="Email">
              <div id="modifica-parola"></div>
            </div>
            <div class="buton-container">
              <button class="create-account-red" type="submit" id="buton-resetare">Reseteaza</button>
            </div>
          </div>
        </div>
        {{-- <div class = "am-cont">Am cont.<div class = "logheaza" id = "login-rezident">Log in</div></div> --}}
      </form>


      {{-- form mobile --}}

      <div class="login" id="login-mobile">
        <div class="close-login"><img src="images/close-login.svg" class="width"></div>
        <div class="login-mobile-container">
          <div class="login-mobile-container-inside">
            <div class="login-mobile-imagine"><img src="images/login-mobile.svg" class="width"></div>
            <div class="login-titlu">Creaza-ti un cont</div>
            <div class="login-subtitlu login-subtitlu-modificat">Alege ce fel de cont vrei sa-ti creezi si urmareste
              pasii</div>
            <div class="register-mobile-buton" id="register-mobile-medic">Cont medic</div>
            <div class="register-mobile-buton" id="register-mobile-rezident">Cont rezident</div>
            <div class="am-mobile">Am deja cont <div class="am-mobile-link" id='am-cont-medic'>Log in ca Medic</div>
            </div>
            <div class="am-mobile">sau <div class="am-mobile-link" id='am-cont-rezident'>Log in ca Rezident.</div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  @include('parts.header')
  <div id="wrapper">

    <div class="sidenav">
      <div class="container" style="height:100%;">
        <div class="close"><img src="images/close.svg" class="width"></div>
        <div class="sidenav-container">
          <div class="sidenav-inside">
            <a href="" class="sidenav-logo"><img src="images/footer-logo.svg" class="width"></a>
            <div class="sidenav-elemente">
              <a href="" class="sidenav-element @if(Request::path() == '/') sidenav-element-active @endif">Acasa</a>
              <a href="despre"
                class="sidenav-element @if(Request::path() == 'despre') sidenav-element-active @endif">Despre noi</a>
              <a href="servicii"
                class="sidenav-element @if(Request::path() == 'servicii') sidenav-element-active @endif">Servicii</a>
              <a href="contact"
                class="sidenav-element @if(Request::path() == 'contact') sidenav-element-active @endif">Contact</a>
            </div>
            <div class="sidenav-termeni">
              <a href="termeni" class="sidenav-termeni-element">Termeni si conditii</a>
              <a href="politica" class="sidenav-termeni-element">Politica de confidentialitate</a>
              <a href="cookie" class="sidenav-termeni-element">Politica de cookie</a>
            </div>
            <div class="sidenav-social">
              <a href="{{setting('site.facebool')}}" class="footer-social-element"><img src="images/facebook.svg"
                  class="width"></a>
              <a href="{{setting('site.linkedin')}}" class="footer-social-element"><img src="images/linkedin.svg"
                  class="width"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <main id="content">
      @yield('content')
    </main>
    @include('parts.footer')
  </div>
  </div>
  <button class="scroll-up"> <img src="images/sagetica.svg"> </button>

  <!--[if lt IE 9]> <script src="js/html5shiv.js"></script> <![endif]-->
  <script src="js/jquery.js" type="text/javascript"></script>
  <script src="js/common.js" type="text/javascript"></script>
  <script src="js/notify.js" type="text/javascript"></script>
  <script src="js/aos.js" type="text/javascript"></script>
  <script src="js/datepicker.min.js" type="text/javascript"></script>
  <script src="js/datepicker.ro.js" type="text/javascript"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      $.ajaxSetup({

        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      var $formContact = $('#creeaza-cont-medic');
      $('#buton-medic').on('click', function (event) {
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
      var $formContact = $('#delete-account');
      $('#btn-sterge').on('click', function (event) {
        event.preventDefault();
        $.ajax({
          method: 'POST',
          url: '{{ action("AccountController@delete") }}',
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
              window.location.href = "/";

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
      var $formContact = $('#creeaza-cont-rezident');
      $('#buton-rezident').on('click', function (event) {
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
      var $formContact = $('#formular-cont-medic');
      $('#login-medic').on('click', function (event) {
        event.preventDefault();
        $.ajax({
          method: 'POST',
          url: '{{ action("AccountController@login") }}',
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
              window.location.href = 'cont';

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
      var $formContact = $('#formular-cont-rezident');
      $('#login-rezident').on('click', function (event) {
        event.preventDefault();
        $.ajax({
          method: 'POST',
          url: '{{ action("AccountController@login") }}',
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
              window.location.href = 'cont';

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
      var $formContact = $('#reseteaza-parola');
      $('#buton-resetare').on('click', function (event) {
        event.preventDefault();
        $.ajax({
          method: 'POST',
          url: '{{ action("AccountController@modifica_parola") }}',
          data: $formContact.serializeArray(),
          context: this,
          async: true,
          cache: false,
          dataType: 'json'
        }).done(function (res) {
          console.log(res);
          if (res.success == true) {
            $.notify(res.msg, "success");
            if (res.actiune == "verifica-cod") {
              $(res.htmlcodparola).insertAfter("#modifica-parola-container>input[name='email']");
              $("#modifica-parola-container>input[name='email']").remove();
              $("input[name='actiune_modificare']").val("verifica_cod");
              $(".btnModificaParola").prop('disabled', false);
            }
            if (res.actiune == "parola-modificata") {
              setTimeout(function () {
                window.location.reload();
              }, 300);
            }
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
  @stack('scripts')
</body>

</html>