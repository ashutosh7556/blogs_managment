<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
      public function index()
      {
          if (auth()->user()->hasRole('admin')) {
              // Admins see everything
              $posts = Post::with('category', 'user')->latest()->get();

          } elseif (auth()->user()->hasRole('author')) {
              // Authors see their own posts
              $posts = Post::with('category', 'user')
                           ->where('user_id', auth()->id())
                           ->latest()
                           ->get();

          } else {
              // Viewers see only published posts
              $posts = Post::with('category', 'user')
                           ->where('status', 'published') // Assuming you have a 'status' column
                           ->latest()
                           ->get();
          }

          return view('posts.index', compact('posts'));
      }



    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

     public function store(Request $request)
     {
         $validated = $request->validate([
             'title' => 'required|string|max:255',
             'content' => 'required|string',
             'category_id' => 'required|exists:categories,id',
             'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
         ]);

         $imagePath = null;
         if ($request->hasFile('image')) {
             $imagePath = $request->file('image')->store('posts', 'public');
         }

         Post::create([
             'title' => $validated['title'],
             'content' => $validated['content'],
             'category_id' => $validated['category_id'],
             'user_id' => auth()->id(),
             'image' => $imagePath,
         ]);

         return redirect()->route('posts.index')->with('success', 'Post created successfully!');
     }


    public function show(Post $post)
    {
        $this->authorize('view', $post);

        $post->load('feedback.user');

        return view('posts.show', compact('post'));
    }


    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted.');
    }
}
