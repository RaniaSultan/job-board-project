<?php

namespace App\Http\Controllers;
use App\Models\Application;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure the user is authenticated
    }

    /**
     * Display a listing of the resource.
     */

    /**application in progress */
    public function indexEmployerApp(Request $request, $postId = null)
    {
        $this->authorize('viewAny', Application::class); // Ensure the user can view any applications

        $status = $request->query('status'); // Get the 'status' query parameter

        if ($postId) {
            // Fetch the post to ensure it exists
            $post = Post::findOrFail($postId);

            // Fetch applications related to this post with the given status
            switch ($status) {
                case 'accepted':
                    $applications = Application::where('post_id', $postId)
                        ->where('status', 'accepted')
                        ->paginate(3);
                    break;

                case 'rejected':
                    $applications = Application::where('post_id', $postId)
                        ->where('status', 'rejected')
                        ->paginate(3);
                    break;

                case 'cancelled':
                    $applications = Application::where('post_id', $postId)
                        ->where('status', 'cancelled')
                        ->paginate(3);
                    break;

                default:
                    $applications = Application::where('post_id', $postId)
                        ->where('status', 'waiting')
                        ->paginate(3);
                    $status = 'waiting'; // Default to 'waiting' if no status is provided
                    break;
            }

            return view('applications.indexEmployer', [ // in progress , create indexEmployer
                'applications' => $applications,
                'currentStatus' => $status,
                'post_id' => $postId
            ]);
        } else {
            // If no post ID is provided, return a message or redirect
            return redirect()->route('posts.index')->with('error', 'Post ID is required to view applications.');
        }
    }

    // button applications in candidate profile page
    public function index(Request $request)
    {
        $this->authorize('viewAny', Application::class); // Ensure the user can view any applications
        $status = $request->query('status', 'waiting'); // Get the 'status' query parameter, default to 'waiting'

        // Filter applications based on status
        $applications = Application::where('status', $status)->paginate(3);

        return view('applications.index', [
            'applications' => $applications,
            'currentStatus' => $status
        ]);
    }



    /**
     * Display the specified resource.
     */

    public function show(Application $application)
    {
        $this->authorize('view', $application); // Ensure the user can view the application
        return view('applications.show', ['application' => $application]);
    }

    /**
     * Accept candidate application.
     */

    /**application in progress */

    public function acceptEmployerApp(Application $application, $postId = null)
    {
        $application->status = 'accepted';
        $application->save();

        return to_route('applications.indexEmployer', $postId)->with('status', 'Application accepted!');
    }
    public function accept(Application $application)
    {
        $this->authorize('update', $application); // Ensure the user can update the application
        $application->status = 'accepted';
        $application->save();
        return redirect()->route('applications.index')->with('status', 'Application accepted!');
    }

    /**
     * Reject candidate application.
     */

    /**application in progress */

    public function rejectEmployerApp(Application $application, $postId = null)
    {
        $application->status = 'rejected';
        $application->save();

        return to_route('applications.indexEmployer', $postId)->with('status', 'Application rejected!');
    }

    /**
     * downloadResume.
     */
    public function downloadResume(Application $application)
    {
        $file = public_path('resumes/' . $application['resume']);
        return response()->download($file);
    }

    //{{--asset('resumes/applications/' . $post['resume'])--}}


    public function reject(Application $application)
    {
        $this->authorize('update', $application); // Ensure the user can update the application
        $application->status = 'rejected';
        $application->save();
        return redirect()->route('applications.index')->with('status', 'Application rejected!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    public function createApp($postId)
    {
        // $user = Auth::user()->where('type', 'Candidate');
        $user = User::where('user_id', auth::id())->where('type', 'Candidate');
        return view('applications.create', ['user' => $user, 'postId' => $postId]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $postId = $request->input('postId');
        $exists = Application::where('user_id', auth::id())
            ->where('post_id', $postId)
            ->exists();

        if ($exists) {
            return to_route('home')->with('error', 'Application Already Exists!');
        }
        $resume_path = '';
        $data = request()->all();
        
        if (request()->hasFile('pdf')) {
            $resume = request()->file('pdf');
            $resume_path = $resume->store('resumes', 'applicants_resumes');
        }
        $data['resume'] = $resume_path;
        $data['user_id'] = auth::id();
        $data['post_id'] = $postId;
        $application = Application::create($data);
        return to_route('posts.showForEveryOne', $postId)->with('status', 'Application Done!');

    }


    /*Cancel candidate application.
     */
    public function cancel(Application $application)
    {
        $this->authorize('update', $application); // Ensure the user can update the application
        $application->status = 'cancelled';
        $application->save();
        return redirect()->route('applications.index')->with('status', 'Application cancelled!');
    }
}
