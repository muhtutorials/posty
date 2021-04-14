<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only('store', 'destroy');
    }

    public function index()
    {
        // "with" method is eager loading for optimizing queries
        // "latest" is "orderBy('created_at', 'desc')"
        $posts = Post::latest()->with(['user', 'likes'])->paginate(20);

        return view('posts.index', ['posts' => $posts]);
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function store(Request $request)
    {
        $this->validate($request, ['body' => 'required']);

        $request->user()->posts()->create($request->only('body'));

        return back();
    }

    public function destroy(Post $post)
    {
        // check if user is owner of the post (policy)
        $this->authorize('delete', $post);

        $post->delete();

        return back();
    }
}
