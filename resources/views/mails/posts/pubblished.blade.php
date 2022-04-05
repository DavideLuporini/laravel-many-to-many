<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body{
        background-color: whitesmoke;
    }

    ul{
        list-style-type: none;
    }
</style>
<body>
    
    <h1>CONGRATULATION! The post :{{$post->title}} has been pubblished correctly!</h1>
    <h2>date : {{$post->created_at}}</h2>

    <h3>Category : {{$post->category->label}}</h3>

    <ul>
        @forelse($post->tags as $tag)
        <li>
            {{$tag->label}}
        </li>
        @empty
        <li>No tags</li>
        @endforelse
    </ul>

</body>
</html>