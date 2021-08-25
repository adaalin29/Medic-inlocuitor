@extends('parts.template') @section('content')
<div class="container">
    <div class="pagini">
        <a href="" class="pagini-link">Acasa |</a>
        <a href="despre" class="pagini-link">Despre noi</a>
    </div>
    <div class="desspre-container">
        <div class="despre-left" data-aos="fade-right" data-aos-delay="200">
            <div class="despre-titlu">{{setting('despre-noi.titlu')}}</div>
            <div class="despre-descriere">{!!setting('despre-noi.descriere')!!}</div>
        </div>
        <div class="despre-right">
            <img src="{{ route('thumb', ['width:600', setting('despre-noi.imagine')]) }}" class="full-width">
        </div>
    </div>
    <div class="alege-tip">
        <div class="alege-tip-element"data-aos="fade-right" data-aos-delay="100">
            <div class="alege-tip-imagine"><img src="images/pas1.svg" class="width"></div>
            <div class="alege-tip-titlu">{{setting('despre-noi.pas1-titlu')}}</div>
            <div class="alege-tip-descriere">{{setting('despre-noi.pas1-descriere')}}</div>
        </div>
        <div class = "tip-sageata" data-aos="fade-right" data-aos-delay="200"><img src = "images/pas-sageata.svg" class = "width"></div>
        <div class="alege-tip-element" data-aos="fade-right" data-aos-delay="300">
            <div class="alege-tip-imagine"><img src="images/pas2.svg" class="width"></div>
            <div class="alege-tip-titlu">{{setting('despre-noi.pas2-titlu')}}</div>
            <div class="alege-tip-descriere">{{setting('despre-noi.pas2-descriere')}}</div>
        </div>
        <div class = "tip-sageata" data-aos="fade-right" data-aos-delay="400"><img src = "images/pas-sageata.svg" class = "width"></div>
        <div class="alege-tip-element" data-aos="fade-right" data-aos-delay="500">
            <div class="alege-tip-imagine width-imagine-modificat"><img src="images/pas3.svg" class="width"></div>
            <div class="alege-tip-titlu">{{setting('despre-noi.pas3-titlu')}}</div>
            <div class="alege-tip-descriere">{{setting('despre-noi.pas3-descriere')}}</div>
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
            <div class = "index-beneficii-titlu">{{setting('despre-noi.beneficii-titlu')}}</div>
            <div class = "index-beneficii-descriere">{{setting('despre-noi.beneficii-descriere')}}</div>
            <a href="despre" class="buton-albastru">Afla mai multe</a>
        </div>
    </div>
<!--     <div class="desspre-container despre-container-reverse">
        <div class="despre-left despre-left-reverse" data-aos="fade-up" data-aos-delay="200">
            <div class="despre-descriere">{!!setting('despre-noi.descriere2')!!}</div>
        </div>
        <div class="despre-right" data-aos="fade-left">
            <img src="{{ route('thumb', ['width:600', setting('despre-noi.imagine2')]) }}" class="full-width">
        </div>
    </div> -->
</div>
@endsection