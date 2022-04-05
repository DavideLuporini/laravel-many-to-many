<div class="col-6">
    @if ($post->exists)
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
    @else
        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @endif
    @csrf

    <div class="row text-center d-flex align-content-center justify-content-center flex-column">
        {{-- title --}}
        <label for="title">Title</label>
        <div class="col-12">
        <input class="w-100" type="text" id="title" name="title" value="{{ old('title', $post->title) }}">
        </div>
            {{-- content --}}
        <label for="content">Post content</label>
        <div class="col-12">
        <textarea class="w-100" name="content" id="content">{{ old('content', $post->content) }}</textarea>
        </div>

        {{-- image --}}
        <label for="image">image</label>
        <div class="col-12 d-flex">
        <input class="w-100" type="file" id="image" name="image">
        </div>

        <div class="col-12 text-center">
            <div class="row">
        <div class="h-100 w-100 d-flex justify-content-between align-items-start my-5">

            <div class="col-12">

                @foreach($tags as $tag)
                <span class="custom-control custom-switch d-inline-block ml-4">
                    <input type="checkbox" class="custom-control-input" id="tag-{{$loop->iteration}}" value="{{$tag->id}}" name="tags[]"
                    @if (in_array($tag->id, old('tags' , $posts_tags_id ?? [])))
                    checked
                    @endif
                    >
                    <label class="custom-control-label" for="tag-{{$loop->iteration}}">{{$tag->label}}</label>
                </span>   
                @endforeach

                <div class=" col-7 form-group my-3 text-left">
                    <label class="text-left" for="category">Category</label>
                    <select class="form-control" name="category_id">
                        <option value="">No Category</option>
                        @foreach ($categories as $category)
                        <option  
                        @if (old('category_id')== $category->id) selected @endif    
                        value="{{$category->id}}">{{$category->label}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

            <hr>

    </div>
</div>
<div class="col-12 d-flex justify-content-between">
    
    {{-- button back --}}
    <div class="col-3">

        <a href="{{route('admin.posts.index')}}" class="btn btn-warning align-self-start"><i class="fa-solid fa-arrow-left mx-2"></i>BACK</a>
    </div>
    

    {{-- button send + clear --}}
    <div class="col-6">

        <button type="reset" class="btn btn-danger">clear</button>
        <button type="submit" class="btn btn-primary mx-3">send</button>
    </div>
</form>
</div>
