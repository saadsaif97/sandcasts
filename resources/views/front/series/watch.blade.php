@extends('layouts.front')

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
         <vimeo-player :lesson="{{ json_encode($series->lessons->first()) }}"></vimeo-player>
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
