<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PublicController extends Controller
{

    public function index()
    {
        $posts = Post::with('category', 'user')->latest()->paginate(10);
        return view('viewer.posts', compact('posts'));
    }
    public function show(Post $post)
    {
        return view('viewer.show', compact('post'));
    }

}
