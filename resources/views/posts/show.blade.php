@extends('layouts.app')


@section('style')
<style>
body {
    font-family: 'Roboto', sans-serif;
}

.card {
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    background: #fff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
} */

.card-img-top {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 70px;
    height: 70px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    object-fit: cover;
}

.card-body {
    margin-top: 22px;
    padding: 20px;
    background: #fff;
}

.card-title {
    font-family: 'Lora', serif;
    font-size: 1.5rem;
    font-weight: bold;
    color: #007bff;
}

.card-text {
    font-family: 'Roboto', sans-serif;
    font-size: 0.9rem;
    line-height: 2.2;
    color: #343a40;

}

.card-subtitle {
    font-family: 'Roboto', sans-serif;
    font-size: 1.1rem;
    color: #666;
    font-style: italic;
}



.card-footer {
    padding: 10px 20px;
    background: #f1f1f1;
    border-top: 1px solid #ddd;
    font-family: 'Roboto', sans-serif;
    font-size: 0.8rem;
    color: #777;
}
</style>
@endsection

@php
use Carbon\Carbon;
@endphp

@section('navbar')
<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item active">
        <a class="nav-link" href="#raina">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/posts/create">Create Post</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.index', ['status' => 'approved']) }}">Approved Posts</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.index', ['status' => 'pending']) }}">Posts pending</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.index', ['status' => 'rejected']) }}">Rejected Posts </a>
    </li>
</ul>
@endsection

@section('main')
<div class="container mt-5">
    <!-- Job Post Card -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
                <h1 class="card-title mb-0 text-primary">{{ $post['title'] }}</h1>
                <span class="ms-3 text-muted">Last Updated
                    {{ Carbon::parse($post['updated_at'])->format('d M Y, h:i A') }}.</span>
                <img src="{{ asset('/storage/' . $post->logo) }}" class="card-img-top ms-auto" alt="Post Image"
                    style="width: 75px; height: 75px; border-radius: 50%;">
            </div>

            <h5 class="card-subtitle mb-3 text-secondary">
                <small>{{ $post['location'] }}</small> <i class="material-icons" style="font-size:16px">location_on</i>
                |
                <i><small>{{ $post['workType'] }}</small></i>
            </h5>

            <div class="d-flex flex-column flex-md-row align-items-start mb-3">
                <h4 class="card-title text-primary me-4 flex-shrink-0">Job Description:</h4>
                <p class="card-text text-dark flex-grow-1">{{ $post['description'] }}</p>
            </div>

            <div class="d-flex flex-column flex-md-row align-items-start mb-3">
                <h4 class="card-title text-primary me-4 flex-shrink-0">Job Categories:</h4>
                <p class="card-text text-dark flex-grow-1">{{ $post['category'] }}</p>
            </div>

            <div class="d-flex flex-column flex-md-row align-items-start mb-3">
                <h4 class="card-title text-primary me-4 flex-shrink-0">Skills:</h4>
                <p class="card-text text-dark flex-grow-1">{{ $post['skills'] }}</p>
                <div class="card mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('/storage/' . $post->logo) }}" class="img-fluid rounded-start"
                                alt="Post Image" style="object-fit: cover; height: 100%;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h1 class="card-title text-teal">{{ $post['title'] }}</h1>
                                <p class="card-text">{{ $post['description'] }}</p>

                                <div class="mb-3">
                                    <p class="text-teal">Location: <small
                                            class="text-muted">{{ $post['location'] }}</small></p>
                                    <p class="text-teal">Work Type: <small
                                            class="text-muted">{{ $post['workType'] }}</small></p>
                                    <p class="text-teal">Category: <small
                                            class="text-muted">{{ $post['category'] }}</small></p>
                                    <p class="text-teal">Skills: <small class="text-muted">
                                            {{ $post['skills'] }}</small></p>
                                    <p class="text-teal">Benefits: <small class="text-muted">
                                            {{ $post['benefites'] }}</small></p>
                                    <p class="text-teal">Salary: <small class="text-muted">
                                            {{ $post['salaryRange'] }}</small></p>
                                    <p class="text-teal">Deadline: <small class="text-muted">
                                            {{ Carbon::parse($post['deadline'])->format('d M Y') }} at 12:00 AM</small>
                                    </p>

                                </div>
                                <small class="card-text"><small class="text-muted">Last updated
                                        {{ Carbon::parse($post['updated_at'])->format('d M Y, h:i A') }}</small></small>


                                <div class="mb-3">
                                    <h4 class="card-text mb-1 text-primary"><strong>Category:</strong></h4>
                                    <p class="card-text text-dark">{{ $post['category'] }}</p>
                                </div>

                                <div class="d-flex flex-column flex-md-row align-items-start mb-3">
                                    <h4 class="card-title text-primary me-4 flex-shrink-0">Benefits:</h4>
                                    <p class="card-text text-dark flex-grow-1">{{ $post['benefites'] }}</p>
                                </div>

                                <div class="d-flex flex-column flex-md-row align-items-start mb-3">
                                    <h4 class="card-title text-primary me-4 flex-shrink-0">
                                        <strong>Salary:</strong>
                                    </h4>
                                    <p class="card-text text-dark flex-grow-1">{{ $post['salaryRange'] }}
                                    </p>
                                </div>

                                <div class="d-flex flex-column flex-md-row align-items-start mb-3">
                                    <h4 class="card-title text-primary me-4 flex-shrink-0">
                                        <strong>Deadline:</strong>
                                    </h4>
                                    <p class="card-text text-dark flex-grow-1">
                                        {{ Carbon::parse($post['deadline'])->format('d M Y') }} at 12:00 AM
                                    </p>
                                </div>
                            </div>
                            @if($post['status'] == 'approved')
                            <div class="card-footer d-flex justify-content-start">
                                <a class="btn btn-primary me-2"
                                    href="{{ route('applications.index', $post['id']) }}">Applications</a>
                                <a class="btn btn-primary me-2" href="Doaa">Comments</a>
                                <a class="btn btn-primary me-2" href="{{ route('posts.edit', $post['id']) }}">Edit</a>

                                <form id="delete-form" action="{{ route('posts.destroy', $post['id']) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#confirmModal">Delete</button>
                                </form>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="confirmModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this post?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-danger"
                                                    id="confirm-delete-btn">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif($post['status'] == 'pending')
                                <div class="text-center text-warning">
                                    This post is awaiting approval
                                </div>
                                @elseif($post['status'] == 'rejected')
                                <div class="text-center text-danger">
                                    This post has been rejected
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4 bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Comments</h5>
                        @if($post->comments->isEmpty())
                        <p>No comments yet. Be the first to comment!</p>
                        @else
                        @foreach($post->comments as $comment)
                        <div class="mb-3">
                            <h6>{{ $comment->user->name }}</h6>
                            <!-- Assuming each comment has a user relationship -->
                            <p>{{ $comment->body }}</p>
                            <small
                                class="text-muted">{{ Carbon::parse($comment->created_at)->format('d M Y, h:i A') }}</small>
                        </div>
                        <hr>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>


            <script>
            document.addEventListener('DOMContentLoaded', () => {
                const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
                const deleteForm = document.getElementById('delete-form');

                if (confirmDeleteBtn && deleteForm) {
                    confirmDeleteBtn.addEventListener('click', () => {
                        deleteForm.submit();
                    });
                }

            });
            </script>
            @endsection
