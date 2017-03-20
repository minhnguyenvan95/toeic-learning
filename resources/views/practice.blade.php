@extends('app.layout')
@section('login') current-menu-item @endsection

@section('title') @lang('app.title.login') @endsection

@section('maincontent')
    <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="boxed-section">
        <div id="question-nav"></div>
        <div id="question-wrapper" data-type="{{$type}}"></div>
        @if( isset($isPackage) )
          {{ count($data) }}
          @foreach($data as $package)

          {!!html_entity_decode($package->content)!!}

          
          @endforeach
        @else 

        @endif
      </div>
      </div>
    </div>
    </div>
@endsection