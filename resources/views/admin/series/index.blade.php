@extends('layouts.admin')

@section('content')
<h1 class="mt-4">Series: {{ $series->title }}</h1>


<div class="row">
   <div class="col">
      <div class="card mb-4">
         <div class="card-header">
            <i class="fas fa-plus mr-1"></i>
            Create Lesson For Series
         </div>
         <div class="card-body">
            <vue-lesssons default_lessons="{{ $series->lessons }}" series_id="{{ $series->id }}"
               series_title="{{ $series->title }}"></vue-lesssons>
         </div>
      </div>
   </div>
</div>
@endsection
