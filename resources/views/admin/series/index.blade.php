@extends('layouts.admin')

@section('content')


<div class="row">
   <div class="col col-lg-6 offset-lg-3">
      <h3 class="my-4">{{ $series->title }}</h3>
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
