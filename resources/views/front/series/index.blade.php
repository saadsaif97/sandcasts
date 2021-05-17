@extends('layouts.front')

@section('header')

<!-- Header -->
<header class="header text-white pb-80" style="background-image: url('{{ $series->image_path }}')" data-overlay="9">
   <div class="container text-center">

      <div class="row h-100">
         <div class="col-lg-8 mx-auto align-self-center">

            <h1 class="display-4 mt-7 mb-8">{{ $series->title }}</h1>
            <p class="opacity-70 text-uppercase small ls-1 mb-8">{{ $series->description }}</p>
            @auth
            @hasStartedSeries($series)
            <a href="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $series->lessons->first()->id]) }}"
               class="btn btn-primary btn-round">Continue Learning</a>
            @else
            <a href="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $series->lessons->first()->id]) }}"
               class="btn btn-primary btn-round">Start Learning</a>
            @endhasStartedSeries
            @else
            <a href="#" class="btn btn-primary btn-round">Start Learning</a>
            @endauth


         </div>

         <div class="col-12 align-self-end text-center">
            <a class="scroll-down-1 scroll-down-white" href="#section-content"><span></span></a>
         </div>

      </div>

   </div>
</header><!-- /.header -->

@endsection

@section('content')
<div class="section" id="section-content">
   <div class="container">

      <header class="section-header">
         <h2>Lessons</h2>
      </header>

      <ul class="list-group">
         @forelse($series->getOrderedLessons() as $l)
         <li class="list-group-item">
            <a href="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $l->id ]) }}">{{ $l->title }}</a>
         </li>
         @empty
         <p>No lesson in series yet...</p>
         @endforelse
      </ul>


   </div>
</div>
@endsection


@if(session()->has('login'))
<script>
   document.addEventListener('DOMContentLoaded', () => {
      $(function () {
         $('#loginModal').modal('show');
      });
   })
</script>
@endif
