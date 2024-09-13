@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Profile Form -->
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="profileimage" class="col-md-4 col-form-label text-md-end">{{ __('Profile Image') }}</label>

                            <div class="col-md-6">
                                @if ($user->image)
                                    <img src="{{ asset('uploads/' . $user->image) }}" alt="Profile Image" class="img-thumbnail mb-3" width="150">
                                @else
                                    <p>No profile image uploaded.</p>
                                @endif
                                <input id="profileimage" type="file" class="form-control @error('profileimage') is-invalid @enderror" name="image">

                                @error('profileimage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Profile') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div> 
            </div>

            <!-- Applications Filter NavBar -->
            <div class="card mt-4">
                <div class="card-header">{{ __('Your Applications') }}</div>

                <div class="card-body">
                    <nav class="nav">
                        <a class="nav-link {{ $currentStatus === 'waiting' ? 'active' : '' }}" href="{{ route('profile.index', ['status' => 'waiting']) }}">Waiting</a>
                        <a class="nav-link {{ $currentStatus === 'accepted' ? 'active' : '' }}" href="{{ route('profile.index', ['status' => 'accepted']) }}">Accepted</a>
                        <a class="nav-link {{ $currentStatus === 'rejected' ? 'active' : '' }}" href="{{ route('profile.index', ['status' => 'rejected']) }}">Rejected</a>
                        <a class="nav-link {{ $currentStatus === 'cancelled' ? 'active' : '' }}" href="{{ route('profile.index', ['status' => 'cancelled']) }}">Cancelled</a>
                    </nav>

                    <!-- Display filtered applications -->
                    @if ($applications->count())
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th>Application ID</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $application)
                                    <tr>
                                        <td>{{ $application->id }}</td>
                                        <td>{{ $application->status }}</td>
                                        <td>
                                            <!-- Example action buttons -->
                                            @if ($application->status === 'waiting')
                                            <form action="{{ route('applications.accept', $application) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-success btn-sm">Accept</button>
</form>


                                                <form action="{{ route('applications.reject', $application) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                </form>
                                                <form action="{{ route('applications.cancel', $application) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-sm">Cancel</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $applications->links() }} <!-- Pagination links -->
                    @else
                        <p>No applications found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
