@extends('layouts.admin')

@section('content')
<h1 class="my-4">Create Series</h1>


<div class="row">
   <div class="col">
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
                  <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
                  <input type="submit" value="Create series" class="btn btn-success btn-sm">
               </div>
            </form>
         </div>
      </div>
   </div>
</div>


@endsection
