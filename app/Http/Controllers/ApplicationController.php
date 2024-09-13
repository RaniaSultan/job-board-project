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
    public function reject(Application $application)
    {
        $this->authorize('update', $application); // Ensure the user can update the application
        $application->status = 'rejected';
        $application->save();
        return redirect()->route('applications.index')->with('status', 'Application rejected!');
    }

    /**
     * Cancel candidate application.
     */
    public function cancel(Application $application)
    {
        $this->authorize('update', $application); // Ensure the user can update the application
        $application->status = 'cancelled';
        $application->save();
        return redirect()->route('applications.index')->with('status', 'Application cancelled!');
    }


    public function cancelcand(Application $application)
    {
        // تحقق من أن التطبيق يعود للمستخدم الحالي
        if ($application->user_id !== Auth::id()) {
            return redirect()->back()->withErrors('Unauthorized action.');
        }
    
        // تحديث حالة التطبيق إلى "cancelled"
        $application->status = 'cancelled';
        $application->save();
    
        // إعادة التوجيه إلى نفس الصفحة مع رسالة النجاح
        return redirect()->route('profile.index', ['status' => 'waiting'])
                         ->with('success', 'Application cancelled successfully.');
    }
    
}