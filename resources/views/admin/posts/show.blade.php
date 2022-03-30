@extends('layouts.app')

@section('content')

{{-- post container --}}
<div class="container">
    <h1 class="mb-3">{{$post->title}}</h1>
    <div class="clearfix">
    @if ($post->image)
     <img src="{{$post->image}}" alt="{{$post->title}}" class="float-right mr-2">
     @endif
     <p>{{$post->content}}</p>
     <time>{{$post->created_at}}</time>
     <div class="d-flex align-items-center justify-content-end">
    </div>
</div>

{{-- button container --}}
<div class="d-flex justify-content-end align-items-end my-5">

    {{-- back --}}
    <a href="{{route('admin.posts.index')}}" class="btn btn-sm btn-warning "><i class="fa-solid fa-arrow-left mx-2"></i>BACK</a>
    {{-- edit --}}
    <a class="btn btn-secondary btn-sm mx-3" href="{{ route('admin.posts.edit', $post->id) }}">
        <i class="fa-solid fa-pen-to-square"></i> EDIT
     </a>
     {{-- delete --}}
    <form class="delete-form" action="{{route('admin.posts.destroy' , $post->id)}}" method='POST'>
        @csrf
        @method('DELETE')
        <button  class="btn btn-sm btn-danger" type="submit"><i class="fa-solid fa-trash mx-2"></i>DELETE</button>
     </form>
</div>
</div>
<script>
    const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const confirmation = confirm(
                    'Are you sure you want to delete this?');
                if (confirmation) e.target.submit();
            })
        });
</script>
@endsection
