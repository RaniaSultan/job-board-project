@extends('layouts.app')

@section('title')
All Applications
@endsection

@section('navbar')
<li class="navbar-item"><a class="nav-link" href="{{ route('applications.index', ['status' => 'waiting']) }}">Pending
    Applications</a></li>
<li class="navbar-item"><a class="nav-link" href="{{ route('applications.index', ['status' => 'accepted']) }}">Accepted
    Applications</a></li>
<li class="navbar-item"><a class="nav-link" href="{{ route('applications.index', ['status' => 'rejected']) }}">Rejected
    Applications</a></li>
<li class="navbar-item"><a class="nav-link"
    href="{{ route('applications.index', ['status' => 'cancelled']) }}">Cancelled Applications</a></li>
@endsection

@section('main')
@if (session('status'))
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
    </div>
  </div>
@endforeach
{{ $applications->links() }}
@endsection