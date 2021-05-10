@extends('layouts.admin')

@section('content')
<h1 class="my-4">All Series</h1>

<div class="table-responsive">
   <table class="table">
      <thead>
         <tr>
            <th scope="col">Title</th>
            <th scope="col">Image</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
         </tr>
      </thead>
      <tbody>
         @forelse ($series as $s)
         <tr>
            <td>{{ $s->title }}</td>
            <td>
               <img src="{{ asset($s->image_url) }}" alt="{{ $s->title }}" style="width: 120px; height: auto;">
            </td>
            <td>
               <a href="{{ route('series.edit', $s->slug) }}" class="btn btn-info btn-sm">Edit</a>
            </td>
            <td>
               <button class="btn btn-danger btn-sm" onclick="confirmDelete()"
                  data-form-id="delete-{{ $s->id }}">Delete</button>
               <form action="{{ route('series.destroy', $s->slug) }}" method="post" id="delete-{{ $s->id }}">
                  @csrf
                  @method('delete')
               </form>
            </td>


         </tr>
         @empty
         <tr>No series yet</tr>
         @endforelse

      </tbody>
   </table>
</div>



@endsection

<script>
   function confirmDelete() {
      const e = window.event.target
      const deleteFromId = e.dataset.formId
      const deleteFrom = document.getElementById(deleteFromId)
      if (confirm('Are you sure?')) {
         deleteFrom.submit()
      }
   }
</script>
