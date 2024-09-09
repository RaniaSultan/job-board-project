@extends('layouts.postLayout')

@php
use Carbon\Carbon;
@endphp

@section('content')
<div class="container mt-5">
    <!-- Job Post Card -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h1 class="card-title mb-0 text-primary">{{ $post['title'] }}</h1>
                <span class="ms-3 text-muted">Last Updated
                    {{ Carbon::parse($post['updated_at'])->format('d M Y, h:i A') }}.</span>
                <img src="{{ asset('/storage/' . $post->logo) }}" class="card-img-top ms-auto mt-4" alt="Post Image"
                    style="width: 75px; height: 75px; border-radius: 50%;">
            </div>
            <h5 class="card-subtitle mb-3 text-secondary">
                <small>{{ $post['location'] }}</small> | <i><small>{{ $post['workType'] }}</small></i>
            </h5>

            <h4 class="card-text mb-3 text-primary"><strong>Job Description:</strong></h4>
            <p class="card-text text-dark">{{ $post['description'] }}</p>

            <h2 class="card-title mb-4 text-primary">Job Details:</h2>

            <div class="mb-3">
                <h4 class="card-text mb-1 text-primary"><strong>Category:</strong></h4>
                <p class="card-text text-dark">{{ $post['category'] }}</p>
            </div>
            <div class="mb-3">
                <h4 class="card-text mb-1 text-primary"><strong>Skills:</strong></h4>
                <p class="card-text text-dark">{{ $post['skills'] }}</p>
            </div>
            <div class="mb-3">
                <h4 class="card-text mb-1 text-primary"><strong>Benefits:</strong></h4>
                <p class="card-text text-dark">{{ $post['benefites'] }}</p>
            </div>
            <div class="mb-3">
                <h4 class="card-text mb-1 text-primary"><strong>Salary:</strong></h4>
                <p class="card-text text-dark">{{ $post['salaryRange'] }}</p>
            </div>
            <div class="mb-3">
                <h4 class="card-text mb-1 text-primary"><strong>Deadline:</strong></h4>
                <p class="card-text text-dark">{{ Carbon::parse($post['deadline'])->format('d M Y') }} at 12:00 AM</p>
            </div>
        </div>
        @if($post['status'] == 'approved')
        <div class="card-footer d-flex justify-content-start">
            <a class="btn btn-primary me-2" href="{{ route('applications.index', $post['id']) }}">Applications</a>
            <a class="btn btn-primary me-2" href="Doaa">Comments</a>
            <a class="btn btn-primary me-2" href="{{ route('posts.edit', $post['id']) }}">Edit</a>

            <form id="delete-form" action="{{ route('posts.destroy', $post['id']) }}" method="POST"
                style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#confirmModal">Delete</button>
            </form>

            <div class="modal fade" id="confirmModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmModalLabel">Confirm Deletion</h5>
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this post?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirm-delete-btn">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            @elseif($post['status'] == 'pending')
            <div class="card-footer text-center" style="color:  #007bff;">
                This post is awaiting approval
            </div>
            @elseif($post['status'] == 'rejected')
            <div class=" card-footer text-center text-danger">
                This post has been rejected
            </div>


            @endif
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