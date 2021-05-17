@extends('layouts.front')

@section('header')

<!-- Header -->
<header class="header text-white pb-80" data-overlay="9">
   <div class="container text-center">

      <div class="row h-100">
         <div class="col-lg-8 mx-auto align-self-center">

            <h1 class="display-4 mt-7">{{ auth()->user()->name }}</h1>
            <p class="mb-8">{{ auth()->user()->username }}</p>
            <h2>29</h2>
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
         <hr>
         <p>This is a sample text inside the header of section. You can use it to provide an introductory sentence to
            your section content for the visitors of your website.</p>
      </header>

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
