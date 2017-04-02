@extends('app.layout')
@section('courses') current-menu-item @endsection

@section('title') @lang('app.title.login') @endsection

@section('maincontent')
<div class="fullwidth-block" id="page-register">
<div class="default-bg">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="boxed-section request-form">

          <div class="row">
          @foreach($question_type as $qt)
          <div class="col-sm-4 qt-fix">
            <a href="{{ url('practice/'.$qt->id) }}">
              <div class="qt-wrapper qt-{{$qt->id}}">{{$qt->name}}</div>
            </a>
          </div>
          @endforeach
          </div>
      </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection