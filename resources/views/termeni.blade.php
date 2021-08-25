@extends('parts.template') @section('content')
<div class="container">
    <div class="pagini">
        <a href="" class="pagini-link">Acasa |</a>
        <a href="termeni" class="pagini-link">Termeni si conditii</a>
    </div>
    <div class="termeni-title">Termeni si conditii</div>
    <div class="termeni-text">{!!setting('site.termeni')!!}</div>
</div>
@endsection