@extends('app.layout')
@section('register') current-menu-item @endsection

@section('title') @lang('app.title.register') @endsection

@section('maincontent')
<div class="fullwidth-block" id="page-register">
<div class="default-bg">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="boxed-section request-form">
        <h2 class="section-title text-center">@lang('form.register')</h2>

        <form id="register-form" method="post" action="{{ url('api/v1/user/create') }}">
          <div class="field">
            <label for="Email">@lang('form.email')</label>
            <input type="email" class="control" id="Email" placeholder="@lang('form.email')" name="email" required="required">
          </div>
          <div class="field">
            <label for="name">@lang('form.name')</label>
            <input type="text" class="control" id="name" placeholder="@lang('form.name')" name="name" required="required">
          </div>
          <div class="field">
            <label for="Password">@lang('form.password')</label>
            <input type="password" class="control" id="Password" placeholder="@lang('form.password')" name="password" required="required">
          </div>
          <div class="field">
            <label for="password_confirmation">@lang('form.password_confirmation')</label>
            <input type="password" class="control" id="password_confirmation" placeholder="@lang('form.password_confirmation')" name="password_confirmation" required="required">
          </div>
          <div class="field no-label">
            <div class="control">
              <input type="submit" class="button fix-position" value="Submit request">
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