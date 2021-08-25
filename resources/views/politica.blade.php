@extends('parts.template') @section('content')
<div class="container">
    <div class="pagini">
        <a href="" class="pagini-link">Acasa |</a>
        <a href="politica" class="pagini-link">Politica de confidentialitate</a>
    </div>
    <div class = "termeni-title">Politica de confidentialitate</div>
    <div class="termeni-text">{!!setting('site.politica')!!}</div>
</div>
@endsection