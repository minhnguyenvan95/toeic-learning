@extends('template.default')

@section('title') @lang('app.title.register') @endsection

@section('body')
<h3>@lang('form.register')</h3>
<form id="register-form" method="post" action="{{ url('api/v1/user/create') }}">
  <div class="form-group">
    <label for="Email">@lang('form.email')</label>
    <input type="email" class="form-control" id="Email" placeholder="@lang('form.email')" name="email" required="required">
  </div>
  <div class="form-group">
    <label for="name">@lang('form.name')</label>
    <input type="text" class="form-control" id="name" placeholder="@lang('form.name')" name="name" required="required">
  </div>
  <div class="form-group">
    <label for="Password">@lang('form.password')</label>
    <input type="password" class="form-control" id="Password" placeholder="@lang('form.password')" name="password" required="required">
  </div>
  <div class="form-group">
    <label for="password_confirmation">@lang('form.password_confirmation')</label>
    <input type="password" class="form-control" id="password_confirmation" placeholder="@lang('form.password_confirmation')" name="password_confirmation" required="required">
  </div>
  
  <button type="submit" class="btn btn-default">Submit</button>
</form>
@endsection