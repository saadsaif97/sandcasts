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
            <a href="#" class="btn btn-primary btn-round">Continue Learning</a>
            @else
            <a href="{{ route('series.watch', $series->slug) }}" class="btn btn-primary btn-round">Start Learning</a>
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
         <h2>Series</h2>
      </header>

      {{--@forelse ($series as $s)
      <div class="row gap-y align-items-center">
         <div class="col-md-6 ml-auto">
            <h4>{{ $s->title }}</h4>
      <p>{{ $s->description }}</p>
      <a href="#">Read More <i class="ti-angle-right fs-10 ml-1"></i></a>
   </div>

   <div class="col-md-5 order-md-first">
      <img class="rounded shadow-2" src="{{ $s->image_path }}" alt="...">
   </div>
</div>
@empty
<h3>No series in the list yet...</h3>
@endforelse--}}


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
