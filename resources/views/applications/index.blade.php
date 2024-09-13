@extends('layouts.app')

@section('title')
All Applications
@endsection

<<<<<<< HEAD
@section('sub-navbar')
<li class="navbar-item">
    <a class="nav-link" href="{{ route('applications.index', ['post_id' => $post_id, 'status' => 'waiting']) }}">Pending
        Applications</a>
</li>
<li class="navbar-item">
    <a class="nav-link"
        href="{{ route('applications.index', ['post_id' => $post_id, 'status' => 'accepted']) }}">Accepted
        Applications</a>
</li>
<li class="navbar-item">
    <a class="nav-link"
        href="{{ route('applications.index', ['post_id' => $post_id, 'status' => 'rejected']) }}">Rejected
        Applications</a>
</li>
<li class="navbar-item">
    <a class="nav-link"
        href="{{ route('applications.index', ['post_id' => $post_id, 'status' => 'cancelled']) }}">Cancelled
        Applications</a>
</li>
=======
@section('navbar')
<!-- <li class="navbar-item">
    <a class="nav-link" href="{{ route('applications.index', ['post_id' => $post_id, 'status' => 'waiting']) }}">Pending
        Applications</a>
    </li>
    <li class="navbar-item">
        <a class="nav-link"
            href="{{ route('applications.index', ['post_id' => $post_id, 'status' => 'accepted']) }}">Accepted
            Applications</a>
    </li>
    <li class="navbar-item">
        <a class="nav-link"
            href="{{ route('applications.index', ['post_id' => $post_id, 'status' => 'rejected']) }}">Rejected
            Applications</a>
    </li>
    <li class="navbar-item">
        <a class="nav-link"
            href="{{ route('applications.index', ['post_id' => $post_id, 'status' => 'cancelled']) }}">Cancelled
            Applications</a>
    </li> -->
<li class="navbar-item"><a class="nav-link" href="{{ route('applications.index', ['status' => 'waiting']) }}">Pending
        Applications</a></li>
<li class="navbar-item"><a class="nav-link" href="{{ route('applications.index', ['status' => 'accepted']) }}">Accepted
        Applications</a></li>
<li class="navbar-item"><a class="nav-link" href="{{ route('applications.index', ['status' => 'rejected']) }}">Rejected
        Applications</a></li>
<li class="navbar-item"><a class="nav-link"
        href="{{ route('applications.index', ['status' => 'cancelled']) }}">Cancelled Applications</a></li>
>>>>>>> 9b22200e0e87bfaf149d22d1ac42e47e38cf7a7c
@endsection

@section('main')
@if (session('status'))
<<<<<<< HEAD
    <div class="alert alert-success mx-auto my-2 w-75">
        {{ session('status') }}
    </div>
=======
<!-- <div class="alert alert-success mx-auto my-2 w-75">
    {{ session('status') }}
</div>
>>>>>>> 9b22200e0e87bfaf149d22d1ac42e47e38cf7a7c
@endif

@if ($applications->isEmpty())
    <div class="alert alert-info mx-auto my-2 w-75">
        No applications found for the selected criteria.
    </div>
@endif

@foreach ($applications as $application)
<<<<<<< HEAD
    <div class="card mx-auto my-2 w-75">
        <div class="card-header">
            {{$application->user->name}}
        </div>
        <div class="card-body">
            <h5 class="card-title">Applicant jobTitle</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Resume</a>

            @if ($currentStatus == 'waiting')
                <form action="{{ route('applications.accept', $application) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success">Accept</button>
                </form>
                <form action="{{ route('applications.reject', $application) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
            @endif
        </div>
=======
<div class="card mx-auto my-2 w-75">
    <div class="card-header">
        {{$application->user->name}}
    </div>
    <div class="card-body">
        <h5 class="card-title">Applicant Job Title</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="{{ route('downloadResume')}}" class="btn btn-primary">Resume</a>
        @if ($currentStatus == 'waiting')
        <form action="{{ route('applications.accept', $application) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-success">Accept</button>
        </form>
        <form action="{{ route('applications.reject', $application) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Reject</button>
        </form>
        @endif

    </div>
</div>
@endforeach

{{ $applications->links() }} -->

<div class="alert alert-success mx-auto my-2 w-75">
    {{ session('status') }}
</div>
@endif

@foreach ($applications as $application)
<div class="card mx-auto my-2 w-75">
    <div class="card-header">
        {{$application->user->name}}
    </div>
    <div class="card-body">
        <h5 class="card-title">Applicant jobTitle</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="{{ route('applications.show', $application) }}" class="btn btn-primary">Show Details</a>

        @if ($currentStatus == 'waiting')
        <form action="{{ route('applications.accept', $application) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-success">Accept</button>
        </form>
        <form action="{{ route('applications.reject', $application) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Reject</button>
        </form>
        @endif
>>>>>>> 9b22200e0e87bfaf149d22d1ac42e47e38cf7a7c
    </div>
@endforeach
{{ $applications->links() }}
@endsection