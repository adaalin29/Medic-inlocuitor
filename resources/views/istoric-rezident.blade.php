@extends('parts.template') @section('content')
<div class="container">
  <a href="cont" class="return-cont">
    <img src="images/right.svg" class="sageata">
    <div class="return-text">Disponibilitate activa</div>
  </a>
  <div class="descriere">Vezi datele cu intervalul orar setat pana acum.</div>
  <div class="istoric-concedii">
    <div class="istoric-left">
      @if($concediuRezident!=NULL)
      @foreach($concediuRezident as $concediu)
      <div class="concediu-item">
        <input class="istoric-date-start" type="text" style="display:none;" value="{{$concediu->start_date}}">
        <input class="istoric-date-end" type="text" style="display:none" value="{{$concediu->end_date}}">
        <div class="concediu-data">
          {{str_replace(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'], ['Duminică', 'Luni', 'Marti', 'Miercuri', 'Joi', 'Vineri', 'Sambata'], Carbon\Carbon::parse($concediu->start_date)->locale('ro')->format('l'))}}
          {{\Carbon\Carbon::parse($concediu->start_date)->format('d-m-Y')}}<span>-</span>{{str_replace(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'], ['Duminica', 'Luni', 'Marti', 'Miercuri', 'Joi', 'Vineri', 'Sambata'], Carbon\Carbon::parse($concediu->end_date)->locale('ro')->format('l'))}}
          {{\Carbon\Carbon::parse($concediu->end_date)->format('d-m-Y')}}</div>
        <div class="concediu-ora">
          {{\Carbon\Carbon::createFromFormat('H:i:s',$concediu->start_hour)->format('h:i')}}<span>-</span>{{\Carbon\Carbon::createFromFormat('H:i:s',$concediu->end_hour)->format('h:i')}}
        </div>
        <div class="concediu-descriere">Pentru a finaliza perioada de concediu, apasati pe butonul de mai jos.</div>
          <div class = "finalizare">
            <label class="checkbox disponibilitate-buton-finalizare" data-id = "{{$concediu->id}}" action = "{{ action("AccountController@disponibilitate_finalizata") }}">
              <input type="checkbox" @if($concediu->is_finished ==1) checked @endif >
              <span></span>
              <div class="form-terms-text-contact">Am finalizat perioada</div>
          </label>
          </div>
      </div>
      @endforeach
      @else
      <div class="descriere">Nu exista concedii programate</div>
      @endif
    </div>
    <div class="istoric-right">
      <div class="calendar-left-inside">
        <div id="calendar" class="datepicker-here" data-range="true" data-multiple-dates-separator=" - "></div>
      </div>
    </div>
  </div>
</div>
@endsection