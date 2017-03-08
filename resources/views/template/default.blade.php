<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
<title>@section('title')@show</title>
<link href="{{ url('css/app.css') }}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{ url('js/lib.js?v=1') }}"></script>
<script type="text/javascript">
	var API = "{{ url('/api/v1/') }}";
</script>
<style>

</style>
</head>
<body>
<div class="container">
<div class="row">
@section('body')@show
</div>
</div>

<script type="text/javascript" src="{{ url('js/app.js?v=1') }}"></script>
</body>
</html>
