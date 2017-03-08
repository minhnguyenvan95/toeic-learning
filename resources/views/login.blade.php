@extends('template.default')

@section('title') @lang('app.title.login') @endsection

@section('body')
<h3>@lang('form.login')</h3>
<form id="login-form" method="post" action="{{ url('api/v1/user/login') }}">
  <div class="form-group">
    <label for="Email">@lang('form.email')</label>
    <input type="email" class="form-control" id="Email" placeholder="@lang('form.email')" name="email" required="required">
  </div>

  <div class="form-group">
    <label for="Password">@lang('form.password')</label>
    <input type="password" class="form-control" id="Password" placeholder="@lang('form.password')" name="password" required="required">
  </div>
  
  <button type="submit" class="btn btn-default">Submit</button>
</form>
@endsection