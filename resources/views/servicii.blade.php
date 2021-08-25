@extends('parts.template') @section('content')
<div class="container">
    <div class="pagini">
        <a href="" class="pagini-link">Acasa |</a>
        <a href="servicii" class="pagini-link">Servicii</a>
    </div>
    <div class="desspre-container">
        <div class="despre-left" data-aos="fade-right" data-aos-delay="200">
            <div class="despre-titlu">{{setting('servicii.titlu')}}</div>
            <div class="despre-descriere">{!!setting('servicii.descriere')!!}</div>
        </div>
        <div class="despre-right">
            <img src="{{ route('thumb', ['width:600', setting('servicii.imagine')]) }}" class="full-width">
        </div>
    </div>
    <div class = "servicii-container">
        <div class = "servicii-left">
            <img src="{{ route('thumb', ['width:600', setting('servicii.servicii-imagine')]) }}" class="full-width">
        </div>
        <div class="index-beneficii-left">
            <div class="index-beneficiu" data-aos="fade-right" data-aos-delay="100">
                <div class = "index-beneficiu-imagine">
                    <img src = "images/index-beneficiu1.svg" class = "width">
                    <img src = "images/index-beneficiu1-white.svg" class = "width white-image">
                </div>
                <div class="index-beneficiu-titlu">{{setting('servicii.serviciu1-titlu')}}</div>
                <div class="index-beneficiu-descriere">{{setting('servicii.serviciu1-descriere')}}</div>
            </div>
            <div class="index-beneficiu" data-aos="fade-right" data-aos-delay="200">
                <div class = "index-beneficiu-imagine">
                    <img src = "images/index-beneficiu2.svg" class = "width">
                    <img src = "images/index-beneficiu2-white.svg" class = "width white-image">
                </div>
                <div class="index-beneficiu-titlu">{{setting('servicii.serviciu2-titlu')}}</div>
                <div class="index-beneficiu-descriere">{{setting('servicii.serviciu2-descriere')}}</div>
            </div>
            <div class="index-beneficiu" data-aos="fade-right" data-aos-delay="300">
                <div class = "index-beneficiu-imagine">
                    <img src = "images/index-beneficiu3.svg" class = "width">
                    <img src = "images/index-beneficiu3-white.svg" class = "width white-image">
                </div>
                <div class="index-beneficiu-titlu">{{setting('servicii.serviciu3-titlu')}}</div>
                <div class="index-beneficiu-descriere">{{setting('servicii.serviciu3-descriere')}}</div>
            </div>
            <div class="index-beneficiu" data-aos="fade-right" data-aos-delay="400">
                <div class = "index-beneficiu-imagine">
                    <img src = "images/index-beneficiu4.svg" class = "width">
                    <img src = "images/index-beneficiu4-white.svg" class = "width white-image">
                </div>
                <div class="index-beneficiu-titlu">{{setting('servicii.serviciu4-titlu')}}</div>
                <div class="index-beneficiu-descriere">{{setting('servicii.serviciu4-descriere')}}</div>
            </div>
        </div>
    </div>
    <div class="desspre-container">
        <div class="despre-left" data-aos="fade-right" data-aos-delay="200">
            <div class="despre-descriere">{!!setting('servicii.descriere2')!!}</div>
        </div>
        <div class="despre-right">
            <img src="{{ route('thumb', ['width:600', setting('servicii.imagine2')]) }}" class="full-width">
        </div>
    </div>
</div>
@endsection