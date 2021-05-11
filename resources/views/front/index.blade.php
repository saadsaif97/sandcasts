@extends('layouts.front')

@section('header')

<!-- Header -->
<header class="header text-white h-fullscreen pb-80"
   style="background-image: url('https://source.unsplash.com/1600x900/?nature,water')" data-overlay="9">
   <div class="container text-center">

      <div class="row h-100">
         <div class="col-lg-8 mx-auto align-self-center">

            <h1 class="display-4 mt-7 mb-8">Building Website Using laravel 8</h1>
            <p class="opacity-70 text-uppercase small ls-1">Laravel provides amazing development experience</p>
            <a href="#" class="btn btn-primary btn-round">See demos</a>
            <a href="#" class="btn btn-outline-light btn-round">Features</a>


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

      @forelse ($series as $s)
      <div class="row gap-y align-items-center">
         <div class="col-md-6 ml-auto">
            <h4>{{ $s->title }}</h4>
            <p>{{ $s->description }}</p>
            <h3>{{ $s->image_url }}</h3>
            <a href="#">Read More <i class="ti-angle-right fs-10 ml-1"></i></a>
         </div>

         <div class="col-md-5 order-md-first">
            <img class="rounded shadow-2" src="{{ {{ $s->image_path }} }}" alt="...">
         </div>
      </div>
      @empty
      <h3>No series in the list yet...</h3>
      @endforelse


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
