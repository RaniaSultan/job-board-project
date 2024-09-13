<?php

namespace App\Http\Controllers;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    
        // public function index(Request $request, $status)
        public function index(Request $request)
        {
            $status = $request->query('status', 'waiting'); // Default to 'waiting' if no status is provided
    
            $applications = Application::where('user_id', Auth::id())
                ->where('status', $status)
                ->paginate(10);
    
            return view('auth/profile', [
                'applications' => $applications,
                'currentStatus' => $status,
                'user' => Auth::user() // Pass the authenticated user data
            ]);
        }
    

    public function show()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }
    public function update(Request $request)
    {
        $my_path = '';

       
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'profileimage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        if(request()->hasFile("image")){

            $image = request()->file("image");
            $my_path=$image->store('profile_images','profile_images');

        }
        $user->image= $my_path;


        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }
}
