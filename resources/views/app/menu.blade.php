<div class="primary-header">
	<div class="container">
		<a href="{{url('')}}" id="branding">
			<img src="images/logo.png" alt="Lincoln high School">
			<h1 class="site-title">Toeic Learning</h1>
		</a> <!-- #branding -->
		
		<div class="main-navigation">
			<button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
			<ul class="menu">
				<li class="menu-item @section('homepage')@show"><a href="{{url('')}}">Home</a></li>
				<li class="menu-item @section('courses')@show"><a href="{{url('courses')}}">Courses</a></li>
				<li class="menu-item @section('posts')@show"><a href="{{url('posts')}}">Posts</a></li>
				@if(Auth::guest())
				<li class="menu-item @section('register')@show"><a href="{{url('register')}}">Register</a></li>
				<li class="menu-item @section('login')@show"><a href="{{url('login')}}">Login</a></li>
				@else
				<li class="menu-item @section('dashboard')@show"><a href="{{url('dashboard')}}">Dashboard</a></li>
				<li class="menu-item"><a href="{{url('logout')}}">Logout</a></li>
				@endif
			</ul> <!-- .menu -->
		</div> <!-- .main-navigation -->

		<div class="mobile-navigation"></div>
	</div> <!-- .container -->
</div> <!-- .primary-header -->