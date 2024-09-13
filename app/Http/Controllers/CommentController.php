<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;  // استدعاء الـ Model

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = auth()->user()->id;
        $comment->commentable_id = $request->input('post_id');
        $comment->commentable_type = 'App\Models\Post';  // Assuming comments are for posts
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        // تحقق أن المستخدم الذي يحاول التعديل هو من أنشأ التعليق أو أنه Admin
        if (auth()->user()->id !== $comment->user_id && auth()->user()->type !== 'admin') {
            return redirect()->back()->with('error', 'You are not authorized to edit this comment.');
        }

        
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->back()->with('success', 'Comment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)  
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully');
       
    }
}
