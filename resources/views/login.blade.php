@extends('app.layout')
@section('login') current-menu-item @endsection

@section('title') @lang('app.title.login') @endsection

@section('maincontent')
<div class="fullwidth-block" id="page-register">
<div class="default-bg">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="boxed-section request-form">
        <h2 class="section-title text-center">@lang('form.login')</h2>
		<form id="login-form" method="post" action="{{ url('api/v1/user/login') }}">
		  <div class="field">
		    <label for="Email">@lang('form.email')</label>
		    <input type="email" class="control" id="Email" placeholder="@lang('form.email')" name="email" required="required">
		  </div>

		  <div class="field">
		    <label for="Password">@lang('form.password')</label>
		    <input type="password" class="control" id="Password" placeholder="@lang('form.password')" name="password" required="required">
		  </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="field no-label">
            <div class="control">
              <input type="submit" class="button fix-position" value="Login">
            </div>
          </div>
          <div class="status"></div>
          </form>
      </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection