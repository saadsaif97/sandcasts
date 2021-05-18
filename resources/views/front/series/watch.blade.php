@extends('layouts.front')

@php
$nextLesson = $lesson->nextLesson();
$previousLesson = $lesson->previousLesson();

@endphp

@section('header')

<!-- Header -->
<header class="header text-white pb-80" style="background-image: url('{{ $series->image_path }}')" data-overlay="9">
   <div class="container text-center">
      <h1 class="display-4 mb-6"><strong>{{ $series->title }}</strong></h1>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Library</li>
         </ol>
      </nav>
   </div>
</header><!-- /.header -->

@endsection

@section('content')
<div class="section" id="section-content">
   <div class="container">
      <header class="section-header">
         <h2>Lessons</h2>
      </header>

      <div class="row justify-content-center">
         <vimeo-player :lesson="{{ json_encode($lesson) }}" @if($nextLesson)
            next_lesson_url="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $nextLesson->id ]) }}"
            @endif></vimeo-player>
      </div>

      <div class="d-flex justify-content-center w-100 my-4">
         @if($previousLesson->id !== $lesson->id)
         <a href="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $previousLesson->id ]) }}"
            class="btn btn-primary mr-1">Previous Lesson</a>
         @endif

         @if($nextLesson->id !== $lesson->id)
         <a href="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $nextLesson->id ]) }}"
            class="btn btn-primary ml-1">Next Lesson</a>
         @endif
      </div>

      <ul class="list-group">
         @forelse($series->getOrderedLessons() as $l)
         <li class="list-group-item
         @if($l->id === $lesson->id)
            active bg-light
         @endif
         ">
            <a href="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $l->id ]) }}">{{ $l->title }}</a>
            @if(auth()->user()->hasCompletedLesson($l))
            <span class="badge badge-pill badge-success">completed</span>
            @endif
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
