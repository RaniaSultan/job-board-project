@extends('layouts.app')

@php
use Carbon\Carbon;
@endphp

@section('content')
<div class="container mt-5">
    <!-- Job Post Card -->
    <div class="card mb-3" style="max-width: 100%;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('/storage/' . $post->logo) }}" class="img-fluid rounded-start" alt="Post Image" style="object-fit: cover; height: 100%;">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="card-title text-teal">{{ $post['title'] }}</h1>
                    <p class="card-text">{{ $post['description'] }}</p>
                   
                    <div class="mb-3">
                        <p class="text-teal">Location: <small class="text-muted">{{ $post['location'] }}</small></p>
                        <p class="text-teal">Work Type: <small class="text-muted">{{ $post['workType'] }}</small></p>
                        <p class="text-teal">Category: <small class="text-muted">{{ $post['category'] }}</small></p>
                        <p class="text-teal">Skills: <small class="text-muted"> {{ $post['skills'] }}</small></p>
                        <p class="text-teal">Benefits: <small class="text-muted"> {{ $post['benefites'] }}</small></p>
                        <p class="text-teal">Salary: <small class="text-muted"> {{ $post['salaryRange'] }}</small></p>
                        <p class="text-teal">Deadline: <small class="text-muted"> {{ Carbon::parse($post['deadline'])->format('d M Y') }} at 12:00 AM</small></p>
                                            
                    </div>
                    <small class="card-text"><small class="text-muted">Last updated {{ Carbon::parse($post['updated_at'])->format('d M Y, h:i A') }}</small></small>

                </div>
                
                <div class="card-footer d-flex justify-content-start bg-light">
                    @if($post['status'] == 'approved')
                    <a class="btn btn-outline-success me-2" href="#">Applications</a>
                    <!-- <a class="btn btn-primary me-2" href="#">Comments</a> -->
                    <a class="btn btn-outline-primary me-2" href="{{ route('posts.edit', $post['id']) }}">Edit</a>

                    <form id="delete-form" action="{{ route('posts.destroy', $post['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmModal">Delete</button>
                    </form>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="confirmModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
