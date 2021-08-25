<header id="header">
    <div class="container header-container">
        <div class="header-left">
            <a href="/" class="header-link @if(Request::path() == '/') header-link-selected @endif">Acasa</a>
            <a href="despre" class="header-link @if(Request::path() == 'despre') header-link-selected @endif">Despre
                noi</a>
            <a href="servicii"
                class="header-link @if(Request::path() == 'servicii') header-link-selected @endif">Servicii</a>
            <a href="contact"
                class="header-link @if(Request::path() == 'contact') header-link-selected @endif">Contact</a>
        </div>
         @if(Request::path() == 'concediu' || Request::path() == 'date' || Request::path() == 'pachete' || Request::path() == 'istoric')
        <div class="menu menu-concediu"><img src="images/menu.svg" class="width"></div>
        <a href = "/cont" class="menu-sageata"><img src="images/right.svg" class="width"></a>
        @else
        <div class="menu"><img src="images/menu.svg" class="width"></div>
        @endif
        <div class="header-center">
            <a href="" class="header-logo"><img src="images/logo.svg" class="width logo-desktop"> <img
                    src="images/logo-mobile.svg" class="width logo-mobile"></a>
        </div>
        <div class="header-buton-gol" id="cont-login">Log in</div>
        <div class="header-right">
            @if (Session::has('user') )
            <form class="logout-cont"  id="form-logout" action='{{ action("AccountController@logout") }}' method="post">
                {{ csrf_field() }}
                <button class="header-buton-plin btnLogout" type="submit">Logout</button>
              </form>
            <a href = "cont" class="header-buton-plin">Contul meu</a>
            @else
            <div class="header-buton-plin" id="buton-cont-rezident">Cont rezident</div>
            <div class="header-buton-plin" id="buton-cont-medic">Cont medic</div>
        </div>
        @endif
    </div>
</header>