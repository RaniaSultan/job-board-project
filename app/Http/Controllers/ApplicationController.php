<?php

namespace App\Http\Controllers;
use App\Models\Application;
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
    public function index(Request $request)
    {
        $this->authorize('viewAny', Application::class); // Ensure the user can view any applications
        $status = $request->query('status'); // Get the 'status' query parameter
        switch ($status) {
            case 'accepted':
                $applications = Application::where('status', 'accepted')->paginate(3);
                break;

            case 'rejected':
                $applications = Application::where('status', 'rejected')->paginate(3);
                break;

            case 'cancelled':
                $applications = Application::where('status', 'cancelled')->paginate(3);
                break;

            default:
                $applications = Application::where('status', 'waiting')->paginate(3);
                $status = 'waiting';
                break;
        }

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
    public function accept(Application $application)
    {
        $application->status = 'accepted';
        $application->save();
        return to_route('applications.index')->with('status', 'Application accepted!');
    }

    /**
     * Reject candidate application.
     */
    public function reject(Application $application)
    {
        $application->status = 'rejected';
        $application->save();
        return to_route('applications.index')->with('status', 'Application rejected!');
    }
}
