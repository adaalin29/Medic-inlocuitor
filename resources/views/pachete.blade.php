@extends('parts.template') @section('content')
<div class="container">
    <a href="cont" class="return-cont">
        <img src="images/right.svg" class="sageata">
        <div class="return-text">Pachet de servicii</div>
    </a>
    <div class="descriere">{!!setting('pachet-de-servicii.descriere')!!}</div>
    <div class = "expirare pachet-expirare">Data expirarii: <div class = "expirare-data">{{$user->exp_date}}</div></div>
    <div class = "vezi">* Vezi politica de cumparare a pachetelor, care sunt drepturile tale si ce raspunderi ne asumam noi in <a href = "termeni" class = "vezi-link">Termeni si conditii.</a></div>
    <div class="pachete-container">
        
       
      <div class="pachet"  data-aos="fade-left" data-aos-delay="100">
            <div class="pachet-titlu">
                <div class="pachet-text" style="color:#FFD500;">Pachet Gold - 6 luni</div>
            </div>
            <div class="pachet-pret">{{$pachete[0]->pret}} lei</div>
            <div class="pachet-servicii">
                @foreach($serviciiBaza as $serviciu)
                <div class="pachet-serviciu">
                    <div class="pachet-serviciu-text">{{$serviciu->name}}</div>
                    <div class="pachet-imagine"><img src="images/check-galben.svg" class="width"></div>
                </div>
                @endforeach
            </div>
            <form class="pachet-form" id="pachet-baza" action='{{ action("PaymentController@sendOrder") }}' method="post">
                {{ csrf_field() }}
                <input style="display:none;" name="tip_pachet" value="{{$pachete[0]->id}}">
                <button class="buton-pachet" type="submit" id="buton-pachet-standard">Cumpara acum</button>
            </form>
        </div>
       <div class="pachet"  data-aos="fade-left" data-aos-delay="200">
            <div class="pachet-titlu">
                <div class="pachet-text" style="color:#03A9F4;">Pachet Platimum - 1 an</div>
            </div>
            {{-- <div class="pachet-pret">{{$pachete[1]->pret}} lei<div class="luna">/luna</div></div> --}}
            <div class="pachet-pret">{{$pachete[1]->pret}} lei</div>
            <div class="pachet-servicii">
                @foreach($serviciiStandard as $serviciu)
                <div class="pachet-serviciu">
                    <div class="pachet-serviciu-text">{{$serviciu->name}}</div>
                    <div class="pachet-imagine"><img src="images/check.svg" class="width"></div>
                </div>
                @endforeach
            </div>
            <form class="pachet-form" id="pachet-standard" action='{{ action("PaymentController@sendOrder") }}' method="post">
                {{ csrf_field() }}
                <input style="display:none;" name="tip_pachet" value="{{$pachete[1]->id}}">
                <button class="buton-pachet" type="submit" id="buton-pachet-baza">Cumpara acum</button>
            </form>
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
   
   $('.buton-pachet').on('click', function (event) {
     vthis = this;
     event.preventDefault();
     $.ajax({
       method: 'POST',
       url: '{{ action("PaymentController@sendOrder") }}',
       data: $(vthis).parent($('.pachet-form')).serializeArray(),
       context: this,
       async: true,
       cache: false,
       dataType: 'json'
     }).done(function (res) {
       console.log(res);
       if (res.success == true) {
        if(res.formular){
            console.log(JSON.parse(res.formular));
            var data = JSON.parse(res.formular);

            var f = document.createElement("form");
            f.setAttribute('name', 'frmPaymentRedirect');
            f.setAttribute('method', 'post');
            f.setAttribute('action', data.postUrl);

            var i1 = document.createElement("input");
            i1.setAttribute('name', 'env_key');
            i1.setAttribute('type', 'hidden');
            i1.setAttribute('value', data.env_key);

            var i2 = document.createElement("input");
            i2.setAttribute('name', 'data');
            i2.setAttribute('type', 'hidden');
            i2.setAttribute('value', data.data);

            f.appendChild(i1);
            f.appendChild(i2);

            document.getElementsByTagName('body')[0].appendChild(f);
            setTimeout(function () { f.submit() }, 1000);

        }
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