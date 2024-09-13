<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
=======
>>>>>>> faa3d43b2db9087416a77c6083abb83b07f40c58

class JobBoardController extends Controller
{
    public function index()
    {
        
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Access denied. Login o view this page.You do not have permission');
        }
      
        $posts = Post::where('status', 'approved')->get();
        return view('jobboard.home', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('jobboard.show', compact('post'));
    }
}
