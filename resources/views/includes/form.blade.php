@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

      <div class="row">
         <div class="col-6">
            @if ($posts->exists)
        <h1>Modifica Post</h1>
        <form action="{{ route('admin.posts.update', $post) }}" method="post">
            @method('PUT')
        @else
            <h1>Aggiungi un Post</h1>
            <form action="{{ route('admin.posts.store') }}" method="post">
    @endif

    @csrf