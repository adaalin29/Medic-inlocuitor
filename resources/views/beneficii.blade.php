@extends('parts.template') @section('content')
<div class="container">
    <a href="cont" class="return-cont">
        <img src="images/right.svg" class="sageata">
        <div class="return-text">Beneficii rezident</div>
    </a>
    <div class="descriere-beneficii" data-aos="fade-right">{!!setting('beneficii-rezident.descriere')!!}</div>
    <div class="expirare">Valabilitate cont: <div class="expirare-data">@if($abonamentExpirat) Abonament expirat @else
            {{$user->exp_date}} @endif</div>
    </div>
    <div class="beneficii-container">
        <div class="beneficiu-item" data-aos="fade-right" data-aos-delay="100">
            <div class="beneficiu-imagine"><img src="images/index-beneficiu1.svg" class="width"></div>
            <div class="index-beneficiu-titlu">{{setting('beneficii-rezident.beneficiu1-titlu')}}</div>
            <div class="index-beneficiu-descriere beneficiu-descriere">{{setting('beneficii-rezident.beneficiu1-descriere')}}</div>
        </div>
        <div class="beneficiu-item"data-aos="fade-right" data-aos-delay="200">
            <div class="beneficiu-imagine"><img src="images/index-beneficiu2.svg" class="width"></div>
            <div class="index-beneficiu-titlu">{{setting('beneficii-rezident.beneficiu2-titlu')}}</div>
            <div class="index-beneficiu-descriere beneficiu-descriere">{{setting('beneficii-rezident.beneficiu2-descriere')}}</div>
        </div>
        <div class="beneficiu-item"data-aos="fade-right" data-aos-delay="300">
            <div class="beneficiu-imagine"><img src="images/index-beneficiu3.svg" class="width"></div>
            <div class="index-beneficiu-titlu">{{setting('beneficii-rezident.beneficiu3-titlu')}}</div>
            <div class="index-beneficiu-descriere beneficiu-descriere">{{setting('beneficii-rezident.beneficiu3-descriere')}}</div>
        </div>
        <div class="beneficiu-item" data-aos="fade-right" data-aos-delay="400">
            <div class="beneficiu-imagine"><img src="images/index-beneficiu4.svg" class="width"></div>
            <div class="index-beneficiu-titlu ">{{setting('beneficii-rezident.beneficiu4-titlu')}}</div>
            <div class="index-beneficiu-descriere beneficiu-descriere">{{setting('beneficii-rezident.beneficiu4-descriere')}}</div>
        </div>
    </div>
    <div class="descriere-beneficii" data-aos="fade-right">{!!setting('beneficii-rezident.descriere2')!!}</div>
</div>
@endsection