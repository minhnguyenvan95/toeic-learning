@extends('admin.layout')
@section('wrapper')
<div class="row">
	<div>Xin chào, {{$user->name}}</div>
	<div>{{$user->email}}</div>
	<div>Chúc bạn một ngày vui vẻ</div>
</div>
@endsection