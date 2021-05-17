@extends('layouts.front')

@section('header')

<!-- Header -->
<header class="header text-white pb-80" data-overlay="9">
   <div class="container text-center">

      <div class="row h-100">
         <div class="col-lg-8 mx-auto align-self-center">

            <h1 class="display-4 mt-7">{{ $user->name }}</h1>
            <p class="mb-8">{{ $user->username }}</p>
            <h2>{{ $user->getTotalNumberOfCompletedLessons() }}</h2>
            <p>Lessons completed</p>

         </div>

         <div class="col-12 align-self-end text-center">
            <a class="scroll-down-1 scroll-down-white" href="#section-content"><span></span></a>
         </div>

      </div>

   </div>
</header><!-- /.header -->

@endsection

@section('content')
<section class="section">
   <div class="container">
      <header class="section-header">
         <h2>Series Being Wached</h2>
      </header>

      @forelse ($series as $s)
      <div class="row gap-y align-items-center">
         <div class="col-md-6 ml-auto">
            <h4>{{ $s->title }}</h4>
            <p>{{ $s->description }}</p>
            <a href="{{ route('series.single', $s->slug) }}">Read More <i class="ti-angle-right fs-10 ml-1"></i></a>
         </div>

         <div class="col-md-5 order-md-first">
            <img class="rounded shadow-2" src="{{ $s->image_path }}" alt="{{ $s->title }}">
         </div>
      </div>
      @empty
      <h3 class="text-center">No series started yet...</h3>
      @endforelse

   </div>
</section>


<div class="section" id="section-content">

   <div class="container">
      <header class="section-header">
         <h2>Edit You Profile</h2>
         <hr>
      </header>


      <div class="row">
         <div class="col-3">
            <ul class="nav nav-pills flex-column" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#tab-home-2">Personal Details</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#tab-profile-2">Payment and Subscription</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#tab-contact-2">Settings</a>
               </li>
            </ul>
         </div>

         <div class="col-9 bg-gray">
            <div class="tab-content">
               <div class="tab-pane fade show active" id="tab-home-2">Tab 1 - Personal Details</div>
               <div class="tab-pane fade" id="tab-profile-2">Tab 2 - Payment and Subscription</div>
               <div class="tab-pane fade" id="tab-contact-2">Tab 3 - Settings</div>
            </div>
         </div>
      </div>


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
