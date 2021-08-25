@extends('parts.template') @section('content')
<div class="container">
    <div class="pagini">
        <a href="" class="pagini-link">Acasa |</a>
        <a href="cookie" class="pagini-link">Politica de cookie</a>
    </div>
    <div class = "termeni-title">Politica de cookie</div>
    <div class="termeni-text">{!!setting('site.cookie')!!}</div>
</div>
@endsection