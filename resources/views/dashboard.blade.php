@extends('app.layout')
@section('dashboard') current-menu-item @endsection

@section('title') @lang('app.title.login') @endsection

@section('maincontent')
<div class="fullwidth-block" id="page-register">
<div class="default-bg">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="boxed-section request-form">
        <h2 class="section-title text-center">Dashboard</h2>

          <form id="dashboard-form" method="post" action="{{ url('api/v1/user/update') }}">
          <input type="hidden" name="api_token" value="{{$user->api_token}}">
          <div class="field">
            <label for="Email">@lang('form.email')</label>
            <input type="email" class="control" id="Email" name="email" required="required" value="{{$user->email}}">
          </div>
          <div class="field">
            <label for="name">@lang('form.name')</label>
            <input type="text" class="control" id="name" name="name" required="required" value="{{$user->name}}">
          </div>
          <div class="field">
            <label for="Password">@lang('form.password')</label>
            <input type="password" class="control" id="Password" name="password">
          </div>
          <div class="field">
            <label for="password_confirmation">@lang('form.password_confirmation')</label>
            <input type="password" class="control" id="password_confirmation" name="password_confirmation">
          </div>
          <div class="field no-label">
            <div class="control">
              <input type="submit" class="button fix-position" value="Edit">
            </div>
          </div>
          <center><img style="display:none" class="ajax-loader" src="{{url('images/ajax-loader.gif')}}"/></center>
          <div class="status"></div>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection