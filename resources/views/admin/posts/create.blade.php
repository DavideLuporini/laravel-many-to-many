@extends('layouts.app');

@section('content')

    @include('admin.posts.includes.form')
    
@endsection

<script>
    const title = document.getElementById("title");
    console.log(title.value)
    let dtitle = document.getElementById("d-title");

    title.addEventListener("change", function(){
        const titleValue = title.value;
  dtitle.innerHTML = titleValue;
});

</script>