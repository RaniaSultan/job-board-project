<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');

    // }
// app/Http/Controllers/PostController.php




    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Access denied. You do not have permission to view this page');
        }
        $user = Auth::user();
        if (!in_array($user->type, ['employer', 'admin'])) {
            //return redirect('/')->with('error', 'Access denied.');
            abort(403, 'Access denied. You do not have permission to view this page.');

        }

    $status = $request->query('status');

    //all posts
    if ($status === 'approved') {
        $posts = Post::where('status', 'approved')->orderBy('created_at', 'desc')->get();
    } elseif ($status === 'pending') {
        $posts = Post::where('status', 'pending')->orderBy('created_at', 'desc')->get();
    } elseif ($status === 'rejected') {
        $posts = Post::where('status', 'rejected')->orderBy('created_at', 'desc')->get();
    } else {
        return redirect()->route('posts.index', ['status' => 'approved']);
    }


     //my posts

    // if ($status === 'approved') {
    //     $posts = Post::where('user_id', Auth::id())
    //                 ->where('status', 'approved')
    //                 ->orderBy('created_at', 'desc')
    //                 ->get();
    // } elseif ($status === 'pending') {
    //     $posts = Post::where('user_id', Auth::id())
    //                 ->where('status', 'pending')
    //                 ->orderBy('created_at', 'desc')
    //                 ->get();
    // } elseif ($status === 'rejected') {
    //     $posts = Post::where('user_id', Auth::id())
    //                 ->where('status', 'rejected')
    //                 ->orderBy('created_at', 'desc')
    //                 ->get();
    // } else {
    //     return redirect()->route('posts.index', ['status' => 'approved']);
    // }
    return view('posts.index', ['posts' => $posts, 'status' => $status]);

    }



    public function create()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please log in to create posts.');
        }
        $user = Auth::user();
        if ($user->type !== 'employer') {
            abort(403, 'Access denied. Only employers can create posts.');

        }
        $users = User::all();
        return view('posts.create', compact('users'));
    }


    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $logoPath = "";
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->store('post_images', 'public');
            $data['logo'] = $logoPath;
        }
        $post = new Post($data);
        $post->save();
        return redirect()->route('posts.index');
    }


    public function show(Post $post)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please log in to view posts.');
        }
        $user = Auth::user();
        if (!in_array($user->type, ['employer', 'admin'])) {
            //return redirect('/')->with('error', 'Access denied.');
            abort(403, 'Access denied. You do not have permission to view this page.');

        }

            $post = Post::with('comments')->findOrFail($id); // Fetch post with related comments
            return view('posts.show', compact('post'));
    //  return view('posts.show', compact('post'));
    }


    public function edit(Post $post)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please log in to edit posts.');
        }
        $user = Auth::user();
        if ($user->type !== 'employer') {
            abort(403, 'Access denied. Only employers can edit posts.');

        }
        $users = User::all();
        return view('posts.edit', compact('users'), compact('post'));
    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        // dd($data);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->store('post_images', 'public');
            $data['logo'] = $logoPath;
        }
        $post->update($data);
    // dd($data);
    //dd($post);
      return redirect()->route('posts.index');


    }




    public function destroy(Post $post)
    {
        $post->delete();

       return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
