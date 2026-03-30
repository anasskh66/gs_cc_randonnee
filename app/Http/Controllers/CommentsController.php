<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Trip;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'email' => 'required|email',
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'trip_id' => $request->trip_id,
            'email' => $request->email,
            'comment' => $request->comment,
            'is_visible' => false, // Default to hidden, admin needs to approve
        ]);

        return back()->with('comment_success', 'Your comment has been submitted and is pending approval.');
    }

    /**
     * Display all comments for admin.
     */
    public function index()
    {
        $comments = Comment::with('trip')->orderBy('created_at', 'desc')->get();
        return view('dashboard.comments.index', compact('comments'));
    }

    /**
     * Toggle comment visibility.
     */
    public function toggleVisibility(Comment $comment)
    {
        $comment->update([
            'is_visible' => !$comment->is_visible
        ]);

        $status = $comment->is_visible ? 'visible' : 'hidden';
        return back()->with('success', "Comment has been {$status}.");
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment has been deleted.');
    }
}
