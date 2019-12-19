@extends('layout')

@section('title', 'Thank You')

@section('extra-css')

@endsection

@section('body-class', 'sticky-footer')

@section('content')

   <div class="thank-you-section">
       <h1>Спасибо за заказ</h1>
       <p>Ожидайте звонка в течении 30 минут</p>
       <div class="spacer"></div>
       <div>
           <a href="{{ url('/') }}" class="button">На Главную</a>
       </div>
   </div>




@endsection
