<div class="col-6">
    @if ($post->exists)
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
        @method('PUT')
    @else
        <form action="{{ route('admin.posts.store') }}" method="POST">
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
        <div class="col-12">
        <input class="w-100" type="text" id="image" name="image" value=""{{ old('image', $post->image) }}">
        </div>

        <div class="col-12 text-center">
        <div class="h-100 w-100 d-flex justify-content-between align-items-start my-5">

        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" name="category_id">
                <option value="">No Category</option>
                @foreach ($categories as $category)
                <option  
                @if (old('category_id')== $category->id) selected @endif    
                value="{{$category->id}}">{{$category->label}}</option>
                @endforeach
            </select>

        </div>

            {{-- button back --}}
            <div>
                <a href="{{route('admin.posts.index')}}" class="btn btn-warning align-self-start"><i class="fa-solid fa-arrow-left mx-2"></i>BACK</a>
            </div>

            {{-- button send + clear --}}
            <div>
                <button type="reset" class="btn btn-danger">clear</button>
                <button type="submit" class="btn btn-primary mx-3">send</button>
            </div>
        </div>
        </div>
    </div>
</form>
</div>
