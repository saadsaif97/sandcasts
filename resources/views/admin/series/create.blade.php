@extends('layouts.admin')

@section('content')
<h1 class="mt-4">Series</h1>


<div class="row">
   <div class="col-xl-6">
      <div class="card mb-4">
         <div class="card-header">
            <i class="fas fa-plus mr-1"></i>
            Create a series
         </div>
         <div class="card-body">
            <form action="{{ route('series.store') }}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" name="title" id="title" class="form-control form-control-sm"
                     value="{{ old('title') }}">
                  <p class="text-danger">@error('title') {{ $message }} @enderror</p>
               </div>
               <div class="form-group">
                  <label for="image">Image</label>
                  <input type="file" name="image" id="image" class="form-control-file">
                  <p class="text-danger">@error('image') {{ $message }} @enderror</p>
               </div>
               <div class="form-group">
                  <label for="description">Description</label>
                  <textarea name="description" id="description" class="form-control form-control-sm"
                     rows="7">{{ old('description') }}</textarea>
                  <p class="text-danger">@error('description') {{ $message }} @enderror</p>
               </div>
               <div class="form-group">
                  <input type="submit" value="Create series" class="btn btn-success btn-sm">
               </div>
            </form>
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

<div class="row">
   <div class="col-12 col-md-6">
      <a href="{{ route('series.show', $series->slug) }}">{{ $series->title }}</a>
   </div>
</div>
@endsection
