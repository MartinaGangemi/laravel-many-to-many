<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Mail\NewPostCreated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostUpdatedAdminMessage;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderByDesc('id')->get();
        //dd($posts);
        return view ('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        $tags = Tag::all();
        //dd($categories);
        return view('admin.posts.create', compact('categories','tags'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        

        $validated_data = $request->validated();
        $slug = Post::generateSlug($request->title);
        $validated_data['slug'] = $slug;
        

        if ($request->hasFile('img')){
            $request->validate([
                'img'=> 'nullable|image|max:300'
            ]);

           $path = Storage::put('posts_images', $request->img);
           $validated_data['img'] = $path;
        }

        $new_post = Post::create($validated_data);
        $new_post->tags()->attach($request->tags);

        
        Mail::to($request->user())->send(new NewPostCreated($new_post));
        return redirect()->route('admin.posts.index')->with('message', 'Post creato con successo');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {   
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.edit', compact('post','categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $validated_data = $request->validated();
        //dd($validated_data);
        $slug = Post::generateSlug($request->title);
        $validated_data['slug'] = $slug;

        if ($request->hasFile('img')){
            $request->validate([
                'img'=> 'nullable|image|max:300'
            ]);

            Storage::delete($post->img);

           $path = Storage::put('posts_images', $request->img);
           $validated_data['img'] = $path;
        }

        $post->update($validated_data);
        $post->tags()->sync($request->tags);

        
        Mail::to('admin@boolpress.it')->send(new PostUpdatedAdminMessage($post));
        

        return redirect()->route('admin.posts.index');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {   
        Storage::delete($post->img);
        $post->delete();
        return redirect()->route('admin.posts.index');
       
    }
}
