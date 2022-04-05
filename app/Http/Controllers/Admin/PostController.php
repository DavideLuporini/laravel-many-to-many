<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Post;
use App\Model\Category;
use App\Model\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\PubblishedPost;


class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $post = new Post();
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.create', compact('post', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $categories)
    {
        $request->validate(
            [
                'title' => ['required', 'string', 'min:5', 'max:255'],
                'image' => 'nullable|image', //mimes:jpg, png , pdf --> need this to specify the type of the file
                'content' => 'required|string',
                'category_id' => 'nullable|exists:categories,id',
                'tags' => 'nullable|exists:tags,id'
            ],
            [
                'required' => 'Field :attribute is obbligatory!',
                'title.unique' => "A post called $request->title already exist!",
                'title.min' => "$request->title must be longer then 5 caracters!",
                'tags.exists' => 'One of your tags is invalid',
            ]
        );


        $data = $request->all();
        $post = new Post();

        if (array_key_exists('image', $data)) {
            $img_url = Storage::put('post_images', $data['image']);
            $data['image'] = $img_url;
        }

        $post->fill($data);
        $post->save();

        //attach tags
        if (array_key_exists('tags', $data)) $post->tags()->attach($data['tags']);

        //mail
        $mail = new PubblishedPost($post);
        $receiver = Auth::user()->email;
        Mail::to($receiver)->send($mail);

        //end
        return redirect()->route('admin.posts.show', compact('post', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\s  $s
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\s  $s
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Category $categories, Tag $tag)
    {
        $posts_tags_id = $post->tags->pluck('id')->toArray();
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'posts_tags_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\s  $s
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                'title' => ['required', 'string', Rule::unique('posts')->ignore($post->id), 'min:5', 'max:255'],
                'image' => 'required|string',
                'content' => 'required|string',
            ],
            [
                'required' => 'Field :attribute is obbligatory!',
                'title.unique' => "A post called $request->title already exist!",
                'title.min' => "$request->title must be longer then 5 caracters!"
            ]
        );

        $data = $request->all();


        $post->update($data);
        if (array_key_exists('tags', $data)) $post->tags()->sync($data['tags']);

        return redirect()->route('admin.posts.index')->with('message', "$post->title modificato con successo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\s  $s
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', `$post->title has been successfully deleted`)->with('type', 'success');
    }
}
