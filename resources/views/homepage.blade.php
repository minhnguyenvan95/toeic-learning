@extends('app.layout')
@section('homepage') current-menu-item @endsection

@section('header')
<div class="home-slider">
	<div class="container">
		<div class="slider">
			<ul class="slides">
				<li>
					<div class="slide-caption">
						<h2 class="slide-title">I Love to learn! <br> Welcome back school!</h2>
						<p>You can improve your English skill by joining our team <br>Learning everywhere you can with any devices you have.</p>
						<a href="#" class="button primary large">Learn more</a>
					</div>
					<img src="dummy/kid.png" alt="">
				</li>
				<li>
					<div class="slide-caption">
						<h2 class="slide-title">I Love to Read &amp; Listen! </h2>
						<p>We have more than 1000 reading &amp; listening comprehension practice for you to improve your reading skill.<br>By Signup, You've became a part of our learning team.</p>
						<a href="#" class="button primary large">Learn more</a>
					</div>
					<img src="dummy/kid.png" alt="">
				</li>
				<li>
					<div class="slide-caption">
						<h2 class="slide-title">Free English testing!</h2>
						<p>Redefining the way how we learn. We provide many good method to learning . You won't waste your time when joinning us <br>Almost of our courses are free*</p>
						<a href="#" class="button primary large">Learn more</a>
					</div>
					<img src="dummy/kid.png" alt="">
				</li>
			</ul> <!-- .slides -->
		</div> <!-- .slider -->
	</div> <!-- .container -->
</div> <!-- .home-slider -->
@endsection
@section('maincontent')
<div class="fullwidth-block">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h2 class="section-title"><i class="icon-newspaper"></i> Latest Courses</h2>
				<ul class="posts">
					@foreach($latest_courses as $course)
					<li class="post">
						<h3 class="entry-title"><a href="#">{{ $course->questiontype->name }} {{ $course->id }}</a></h3>
						<span class="date"><i class="icon-calendar"></i> {{ $course->created_at }}</span>
					</li>
					@endforeach


				</ul>
				<p class="text-center">
					<a href="#" class="more button secondary">See more Courses</a>
				</p>
			</div>
			<div class="col-md-4">
				<h2 class="section-title"><i class="icon-calendar-lg"></i> Informations</h2>
				<ul class="posts">
					@foreach($new_post as $post)
					<li class="post">
						<h3 class="entry-title"><a href="#">{{$post->title}}</a></h3>
						<span class="date"><i class="icon-calendar"></i>{{$post->created_at}}</span>
					</li>
					@endforeach
				</ul>
				<p class="text-center">
					<a href="#" class="more button secondary">See more informations</a>
				</p>
			</div>
			<div class="col-md-4">
				<h2 class="section-title"><i class="icon-book"></i> New Students</h2>
				<ul class="posts">
					@foreach($new_students as $student)
					<li class="post">
						<span class="student-avatar small">
							<a href="#">
								<img alt="{{$student->name}} profile" src="{{ $student->avatar?$student->avatar:url('/avatar/no-avatar.png') }}">
							</a>
						</span>
						<span class="entry-title"><a href="#">{{ $student->name }}</a></span>
					</li>
					@endforeach
				</ul>
			</div>
		</div> <!-- .row -->
	</div>
</div> <!-- .fullwidth-block -->

<div class="fullwidth-block">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="boxed-section request-form">
					<h2 class="section-title text-center">Registration</h2>
					<form id="register-form" method="post" action="{{ url('api/v1/user/create') }}">
						<div class="field">
							<label for="email">Email Address:</label>
							<div class="control"><input type="text" id="email" name="email" placeholder="example@mail.com" required="required"></div>
						</div>
						<div class="field">
							<label for="name">Your name:</label>
							<div class="control"><input type="text" id="name" name="name" placeholder="John Smith" required="required"></div>
						</div>
						<div class="field">
							<label for="password">Password</label>
							<div class="control"><input type="password" id="password" name="password"></div>
						</div>
						<div class="field">
							<label for="password_confirmation">Confirm Password</label>
							<div class="control"><input type="password" id="password_confirmation" name="password_confirmation"></div>
						</div>
						<div class="field no-label">
							<div class="control">
								<input type="submit" class="button" value="Submit request">
							</div>
						</div>
						<div class="status"></div>
					</form>
				</div> <!-- .boxed-section .request-form -->
			</div>
			<div class="col-md-6">
				<div class="boxed-section best-students">
					<h2 class="section-title  text-center">Our best students</h2>
					<ul class="best-students-grid">
						@foreach($best_students as $student)
						<li class="student"><a title="{{$student->name}}" href="#"><img src="{{ $student->avatar?$student->avatar:url('/avatar/no-avatar.png') }}" alt="{{$student->name}} profile"></a></li>
						@endforeach
					</ul>
				</div> <!-- .boxed-section .best-students -->
			</div>
		</div>  <!-- .row -->
	</div> <!-- .container -->
</div> <!-- .fullwidth-block -->
@endsection
