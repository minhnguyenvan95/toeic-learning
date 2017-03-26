<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Toeic Learning</title>
		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Arvo:400,700|" rel="stylesheet" type="text/css">
		<link href="{{ url('fonts/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
		<!-- Loading main css file -->
		<link rel="stylesheet" href="{{ url('style.css') }}">
		<link rel="stylesheet" href="{{ url('wpProQuiz_front.min.css') }}">
		
		<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->

	</head>


	<body>
		
		<div id="site-content">
			<header class="site-header">
				@include('app.menu')
				<div class="sec-header">
				@section('header')@show
				</div>
			</header>
		</div>

		<main class="main-content">
		@section('maincontent')@show
		</main>

		<footer class="site-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="widget">
							<h3 class="widget-title">Contact us</h3>
							<address>180 Cao Lo street, District 8,HCMC</address>
							<a href="mailto:info@minh.nguyenvan95@gmail.com">minh.nguyenvan95@gmail.com</a> <br>
							<a href="tel:84000000">(84) 0000000</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="widget">
							<h3 class="widget-title">Social media</h3>
							<div class="social-links circle">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-google-plus"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-pinterest"></i></a>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="widget">
							<h3 class="widget-title">Our partners</h3>
							<a target="_blank" href="https://coursera.org">
								<img width="200" src="{{url('/images/logo-coursera.png')}}">
							</a>
							<a href="https://www.edx.org/" target="_blank">
								<img height="40" src="{{url('/images/logo-edx.png')}}">
							</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="widget">
							<h3 class="widget-title">Newsletter</h3>
							<form action="#" class="subscribe">
								<input type="email" placeholder="Email Address...">
								<input type="submit" class="light" value="Subscribe">
							</form>
						</div>
					</div>
				</div>

				<div class="copy">Copyright 2017 Toeic Learning. All rights reserved.</div>
			</div>

		</footer>
		<script type="text/javascript">
		var DOMAIN = "{{url('')}}";
		var API = "{{url('/api/v1/')}}";
		</script>
		<script src="{{url('js/jquery-1.11.1.min.js')}}"></script>
		<script src="{{url('js/plugins.js')}}"></script>
		<script src="{{url('js/app.js?v=2')}}"></script>
		
	</body>

</html>