<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Application;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** when user type is employer */
        $applications = Application::paginate(5);
        return view('applications.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /** when user type is candidate */
        if (Auth::type() === 'Candidate') {
            $user = Auth::user();
            return view('applications.create', compact('user'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApplicationRequest $request)
    {
        /** when user type is candidate */
        $resume_path = '';
        $data = request()->all();
        if (request()->hasFile('pdf')) {
            $resume = request()->file('pdf');
            $resume_path = $resume->store('resumes', 'applicantions_resumes');
        }
        $data['resume'] = $resume_path;
        $application = Application::create($data);
        return to_route('applications.show'); //route to application @candidate profile page
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        return view('applications.show', $application);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        /** when user type is candidate */
        return view('applications.edit', $application);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApplicationRequest $request, Application $application)
    {
        /** when user type is candidate */
        $resume_path = $application->resume;
        $data = request()->all();
        if (request()->hasFile('pdf')) {
            $resume = request()->file('pdf');
            $resume_path = $resume->store('resumes', 'applicantions_resumes');
        }
        $data['resume'] = $resume_path;
        $application->update($data);
        return to_route('applications.show');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        /** when user type is candidate */
        $application->delete();
        return to_route('applications.index')->with('success', 'Application cancelled successfully');
    }

    public function restore($id)
    {
        /** when user type is candidate */
        $deletedApplication = Application::onlyTrashed()->find($id);
        $deletedApplication->restore();
        return to_route('applications.show')->with('success', 'Application restored successfully');
    }
}
