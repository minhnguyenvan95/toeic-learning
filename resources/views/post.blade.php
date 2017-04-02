@extends('app.layout')
@section('courses') current-menu-item @endsection

@section('title') @lang('app.title.login') @endsection

@section('maincontent')
<div class="fullwidth-block inner-content">
        <div class="container">
          <div class="col-md-7">
            <div class="content">
              <article>
                <header>
                  <h2 class="entry-title">{{$first->title}}</h2>
                  <div class="entry-meta">
                    <span class="date"><i class="icon-calendar"></i> {{$first->created_at}}</span>
                  </div>
                </header>

                <div class="entry-content">
                  <p>{{$first->content}}</p>
                </div>
              </article>
            </div>
          </div>
          <div class="col-md-4 col-md-offset-1">
            <aside class="sidebar">
              <h2 class="section-title"><i class="icon-book"></i> Recent Posts</h2>
              <ul class="courses">
                @foreach($posts as $p)
                <li>
                  <h3 class="course-title"><a href="#">{{$p->title}}</a></h3>
                  <div class="course-meta">
                    <span class="date"><i class="icon-calendar"></i> {{$p->created_at}}</span>
                  </div>
                </li>
                @endforeach
              </ul>
            </aside>
          </div>
        </div>
      </div>
@endsection