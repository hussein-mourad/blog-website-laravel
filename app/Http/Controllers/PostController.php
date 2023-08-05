<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Comment;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::latest()->filter(request(['tag', 'search']))->paginate(6);
        // $posts = Post::latest()->get();
        $categories = Category::with(['posts' => function ($query) {
            $query->orderBy('updated_at', 'desc');
        }])->get();
        return view('posts.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'thumbnail' => 'file|mimes:jpeg,png|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }
        $data['user_id'] = auth()->id();
        Post::create($data);
        return redirect('/posts/create')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $reactionsCount = $post->reactions->groupBy('type')->map->count();
        if (auth()->check())
            $userReaction = $post->reactions()->where('user_id', auth()->id())->first();
        return view('posts.show', compact('post', 'reactionsCount', 'userReaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (auth()->id() != $post->user_id)
            return back();
        $categories = Category::all();
        return view('posts.edit', ['post' => $post, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'thumbnail' => 'file|mimes:jpeg,png|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            if (Storage::disk('public')->exists($post->thumbnail))
                Storage::disk('public')->delete($post->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }
        $post->update($data);
        return redirect('/posts/' . $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Make sure logged in user is owner
        if ($post->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        if ($post->thumbnail && Storage::disk('public')->exists($post->thumbnail)) {
            Storage::disk('public')->delete($post->thumbnail);
        }
        $post->delete();
        return redirect('/');
    }
}
