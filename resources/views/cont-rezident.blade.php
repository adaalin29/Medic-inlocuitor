@extends('parts.template') @section('content')
<div class="container">
    @if($abonamentExpirat)
    <form class="abonament" id="reinoieste-abonament">
        <div class="abonament-text">Abonamentul a expirat! Reinoieste abonamentul.</div>
        <button class="cont-buton-rosu" id="btn-reinoieste-abonament">Reinoieste</button>
    </form>
    @endif
    <div class="cont-container">
        <div class="cont-element">
            <div class="cont-element-left">
                <img id="cont-element1-static-img" src="images/medic1-bg.svg">
                <img id="cont-element1-dinamic-img" src="images/rezident1-img.svg">
            </div>
            <div class="cont-element-left-mobile">
                <div class="cont-element-bg"><img src="images/medic1-bg-mobile.svg" class="full-width"></div>
                <div class="cont-element-img" data-aos="fade-right"><img src="images/rezident1-img.svg" class="width">
                </div>
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
                <div class="date-container-mobile">
                    <div class="date-container-element-mobile">Nume si prenume <div
                            class="date-containcer-element-text-mobile">@if($user->name==NULL) Introdu date @else
                            {{$user->name}} @endif</div>
                    </div>
                    <div class="date-container-element-mobile">Telefon <div class="date-containcer-element-text-mobile">
                            @if($user->telefon==NULL) Introdu date @else {{$user->telefon}} @endif</div>
                    </div>
                    <div class="date-container-element-mobile">Email <div class="date-containcer-element-text-mobile">
                            @if($user->email==NULL) Introdu date @else {{$user->email}}</div> @endif</div>
                    <div class="date-container-element-mobile">Numar parafa <div
                            class="date-containcer-element-text-mobile">@if($user->parafa==NULL) Introdu date @else
                            {{$user->parafa}} @endif</div>
                    </div>
                </div>
                <a href="date" class="cont-buton">Modifica datele</a>
            </div>
        </div>
        <div class="cont-element cont-element-reverse">
            <div class="cont-element-left">
                <img id="cont-element-static-img" src="images/medic2-bg.svg">
                <img id="cont-element2-dinamic-img" src="images/rezident2-img.svg">
            </div>
            <div class="cont-element-left-mobile">
                <div class="cont-element-bg"><img src="images/medic2-bg-mobile.svg" class="full-width"></div>
                <div class="cont-element-img" data-aos="fade-right"><img src="images/rezident2-img.svg" class="width">
                </div>
            </div>
            <div class="cont-element-right">
                <div class="cont-element-right-titlu">Beneficii rezident</div>
                <div class="pachet-servicii-descriere">Pachetul  ’’Cost 0 ’’ – inlocuirea in cabinet, a unui medic de familie si posibilitatea practicii in timpul rezidentiatului. </div>
                <div class="expirare">Valabilitate cont: <div class="expirare-data">@if($abonamentExpirat) Abonament
                        expirat @else {{$user->exp_date}} @endif</div>
                </div>
                <a href="beneficii" class="cont-buton">Afla mai multe</a>
            </div>
        </div>
        <div class="cont-element">
            <div class="cont-element-left">
                <img id="cont-element3-static-img" src="images/medic3-bg.svg">
                <img id="cont-element3-dinamic-img" src="images/medic3-img.svg">
            </div>
            <div class="cont-element-left-mobile">
                <div class="cont-element-bg"><img src="images/medic3-bg-mobile.svg" class="full-width"></div>
                <div class="cont-element-img-modificat" data-aos="fade-right"><img src="images/medic3-img.svg"
                        class="width"></div>
            </div>
            <div class="cont-element-right">
                <div class="cont-element-right-titlu">Disponibilitate rezident</div>
                <div class="pachet-servicii-descriere servicii-descriere-auto-height">Pentru a acumula mai multa experienta in practica, in cabinetul unui medic de familie, bifeati in calendar perioada, orele si zona in care sinteti disponibil.
</div>
                @if($abonamentExpirat)
                <div class="cont-buton-rosu" id = "reinoieste-abonament-sus">Reinoieste abonament</div>
                @elseif($user->telefon==null || $user->email==null || $user->id_specializare==null ||
                $user->id_titulatura==null || $user->id_pacienti==null || $user->id_judet==null || $user->locatie==null)
                <a href="date" class="cont-buton-rosu">Adauga date personale</a>
                @else
                <a href="concediu" class="cont-buton-rosu">Vezi detalii</a>
                @endif
            </div>
        </div>
        <div class="cont-element cont-element-reverse">
            <div class="cont-element-left">
                <img id="cont-element3-static-img" src="images/medic4-bg.svg">
                <img id="cont-element2-dinamic-img" class="cont-element2-dinamic-img-rezident"
                    src="images/rezident4-img.svg">
            </div>
            <div class="cont-element-left-mobile">
                <div class="cont-element-bg"><img src="images/medic4-bg-mobile.svg" class="full-width"></div>
                <div class="cont-element-img-modificat" data-aos="fade-right"><img src="images/rezident4-img.svg"
                        class="width"></div>
            </div>
            <div class="cont-element-right">
                <div class="cont-element-right-titlu">Disponibilitate activa</div>
                <div class="pachet-servicii-descriere servicii-descriere-auto-height">Puteti verifica disponibilitatile dumneavoastra active dar si pe cele care s-au realizat deja.</div>
                <a href="istoric" class="cont-buton-rosu">Vezi detalii</a>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $.ajaxSetup({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        var $formContact = $('#reinoieste-abonament');
        $('#btn-reinoieste-abonament').on('click', function (event) {
            event.preventDefault();
            $.ajax({
                method: 'POST',
                url: '{{ action("AccountController@reinoieste_abonament") }}',
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