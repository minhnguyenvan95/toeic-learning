@extends('app.layout')
@section('login') current-menu-item @endsection

@section('title') @lang('app.title.login') @endsection

@section('maincontent')
    <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="boxed-section">
        <div id="question-nav"></div>
        <div id="question-wrapper" data-type="{{$type}}">
          <h2>Please wait .... <img src="{{url('images/ajax-loader.gif')}}"/></h2>          
        </div>

      </div>
      </div>
    </div>
    </div>
@endsection