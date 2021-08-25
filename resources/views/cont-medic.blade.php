@extends('parts.template') @section('content')
<div class="container">
    <div class="cont-container">
        <div class="cont-element">
            <div class="cont-element-left">
                <img id="cont-element1-static-img" src="images/medic1-bg.svg">
                <img id="cont-element1-dinamic-img" src="images/medic1-img.svg">
            </div>
            <div class = "cont-element-left-mobile">
                <div class = "cont-element-bg"><img src = "images/medic1-bg-mobile.svg" class = "full-width"></div>
                <div class = "cont-element-img" data-aos="fade-right"><img src = "images/medic1-img.svg" class = "width"></div>
            </div>
            <div class="cont-element-right">
                <div class="cont-element-right-titlu">Date personale</div>
                <div class="date-container">
                    <div class="date-container-left">
                        <div class="date-container-left-element">Nume si prenume:</div>
                        <div class="date-container-left-element">Telefon:</div>
                        <div class="date-container-left-element">Email:</div>
                        <div class="date-container-left-element">Cod parafa:</div>
                    </div>
                    <div class="date-container-right">
                        <div class="date-contact-right-element">{{$user->name}}</div>
                        @if($user->telefon!=NULL)
                        <div class="date-contact-right-element">{{$user->telefon}}</div>
                        @else
                        <div class="date-contact-right-element">Introdu date</div>
                        @endif
                        <div class="date-contact-right-element">{{$user->email}}</div>
                        @if($user->parafa!=NULL)
                        <div class="date-contact-right-element">{{$user->parafa}}</div>
                        @else
                        <div class="date-contact-right-element">Introdu date</div>
                        @endif
                    </div>
                </div>
                <div class = "date-container-mobile">
                <div class = "date-container-element-mobile">Nume si prenume <div class = "date-containcer-element-text-mobile">@if($user->name==NULL) Introdu date @else {{$user->name}} @endif</div></div>
                <div class = "date-container-element-mobile">Telefon <div class = "date-containcer-element-text-mobile">@if($user->telefon==NULL) Introdu date @else {{$user->telefon}} @endif</div></div>
                <div class = "date-container-element-mobile">Email <div class = "date-containcer-element-text-mobile">@if($user->email==NULL) Introdu date @else {{$user->email}}</div> @endif</div>
                <div class = "date-container-element-mobile">Numar parafa <div class = "date-containcer-element-text-mobile">@if($user->parafa==NULL) Introdu date @else {{$user->parafa}} @endif</div></div>
                </div>
                <a href="date" class="cont-buton">Modifica datele</a>
            </div>
        </div>
        <div class="cont-element cont-element-reverse">
            <div class="cont-element-left">
                <img id="cont-element-static-img" src="images/medic2-bg.svg">
                <img id="cont-element2-dinamic-img" src="images/medic2-img.svg">
            </div>
            <div class = "cont-element-left-mobile">
                <div class = "cont-element-bg"><img src = "images/medic2-bg-mobile.svg" class = "full-width"></div>
                <div class = "cont-element-img" data-aos="fade-right"><img src = "images/medic2-img.svg" class = "width"></div>
            </div>
            <div class="cont-element-right">
                <div class="cont-element-right-titlu">Pachet de servicii</div>
               <div class = "pachet-servicii-descriere">Pachetele noastre de servicii se pliaza pe nevoia dumneavoastra de a avea un concediu extraordinar, oricand doriti .</div>
            <div class = "expirare">Data expirarii: <div class = "expirare-data">{{$user->exp_date}}</div></div>
                <a href="pachete" class="cont-buton">Afla mai multe</a>
            </div>
        </div>
        <div class="cont-element">
            <div class="cont-element-left">
                <img id="cont-element3-static-img" src="images/medic3-bg.svg">
                <img id="cont-element3-dinamic-img" src="images/medic3-img.svg">
            </div>
            <div class = "cont-element-left-mobile">
                <div class = "cont-element-bg"><img src = "images/medic3-bg-mobile.svg" class = "full-width"></div>
                <div class = "cont-element-img-modificat" data-aos="fade-right"><img src = "images/medic3-img.svg" class = "width"></div>
            </div>
            <div class="cont-element-right">
                <div class="cont-element-right-titlu">Calendar program</div>
               <div class = "pachet-servicii-descriere servicii-descriere-auto-height">Va rugam fixati in calendar data dorita pentru concediu</div>
               @if($user->exp_date == null)
                <a href="pachete" class="cont-buton-rosu">Cumpara pachet</a>
               @elseif($abonamentExpirat)
               <a href="pachete" class="cont-buton-rosu">Abonamentul a expirat</a>
                
               @elseif($user->telefon==null || $user->email==null || $user->id_specializare==null || $user->id_titulatura==null || $user->id_pacienti==null || $user->id_judet==null || $user->locatie==null)
               <a href="date" class="cont-buton-rosu">Adauga date personale</a>
               @else
               <a href="concediu" class="cont-buton-rosu">Vezi calendarul</a>
               @endif
            </div>
        </div>
        <div class="cont-element cont-element-reverse">
            <div class="cont-element-left">
                <img id="cont-element3-static-img" src="images/medic4-bg.svg">
                <img id="cont-element2-dinamic-img" src="images/medic4-img.svg">
            </div>
            <div class = "cont-element-left-mobile">
                <div class = "cont-element-bg"><img src = "images/medic4-bg-mobile.svg" class = "full-width"></div>
                <div class = "cont-element-img-modificat" data-aos="fade-right"><img src = "images/medic4-img.svg" class = "width"></div>
            </div>
            <div class="cont-element-right">
                <div class="cont-element-right-titlu">Istoric concedii</div>
               <div class = "pachet-servicii-descriere servicii-descriere-auto-height">Puteti vizualiza concediul deja efectuat sau concediul planificat in perioada urmatoare </div>
                <a href="istoric" class="cont-buton-rosu">Vezi istoricul</a>
            </div>
        </div>
    </div>
</div>
@endsection