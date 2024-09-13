<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JobBoardController extends Controller
{
    public function index()
    {
        // $posts = Post::all();
        // return view('jobboard.home', compact('posts'));
        $posts = Post::where('status', 'approved')->get();
        return view('jobboard.home', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('jobboard.show', compact('post'));
    }
}
