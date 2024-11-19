<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the comment content
        $request->validate([
            'content' => 'required|string|max:1000',  // Ensure content is valid
            'post_id' => 'required|exists:posts,id',  // Ensure the post ID exists
        ]);

        // Create the comment
        Comment::create([
            'user_id' => auth()->id(),  // Store the ID of the currently authenticated user
            'content' => $request->content,
            'post_id' => $request->post_id,
        ]);

        // Redirect back to the post page with a success message
        return back()->with('success', 'Comment posted successfully!');
    }
}
