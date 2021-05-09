@extends('layouts.admin')

@section('content')
<h1 class="mt-4">Series</h1>


<div class="row">
   <div class="col-xl-6">
      <div class="card mb-4">
         <div class="card-header">
            <i class="fas fa-plus mr-1"></i>
            {{ $series->title }}
         </div>
         <div class="card-body">
            <vue-lesssons default_lessons="{{ $series->lessons }}" series_id="{{ $series->id }}"
               series_title="{{ $series->title }}"></vue-lesssons>
         </div>
      </div>
   </div>
   <div class="col-xl-6">
      <div class="card mb-4">
         <div class="card-header">
            <i class="fas fa-chart-bar mr-1"></i>
            Bar Chart Example
         </div>
         <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
      </div>
   </div>
</div>
@endsection
