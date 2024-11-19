<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post; // Import Post model
use Illuminate\Support\Str; // Import Str helper for slugs

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch the latest posts with pagination
        $posts = Post::latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // Generate a unique slug for the post title
        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = Auth::id();

        // Create a new post with validated data
        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        // Retrieve the post by slug
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        // Validate the incoming data
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // Update the slug based on the new title
        $validated['slug'] = Str::slug($validated['title']);

        // Update post with validated data
        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete the post by ID
        Post::findOrFail($id)->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
