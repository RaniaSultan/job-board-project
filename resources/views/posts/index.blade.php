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

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

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
    padding: 20px;
    background: #fafafa;
}

.card-title {
    font-family: 'Lora', serif;
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
}

.card-subtitle {
    font-family: 'Roboto', sans-serif;
    font-size: 1.1rem;
    color: #666;
    font-style: italic;
}

.card-text {
    font-family: 'Roboto', sans-serif;
    font-size: 0.9rem;
    color: #333;
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
        <a class="nav-link" href="{{ route('posts.index', ['status' => 'pending']) }}">Pending Posts </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.index', ['status' => 'rejected']) }}">Rejected Posts </a>
    </li>
</ul>
@endsection

@section('main')

@if (session('success'))
<div class="alert alert-success" id="flash-message">
    {{ session('success') }}
</div>
@endif
<!-- back to sandy -->
@if (session('error'))
<div class="alert alert-success" id="flash-message">
    {{ session('error') }}
</div>
@endif

@if ($posts->count() > 0)
@foreach($posts as $post)


<div class="container  mt-5">
    <div class="card mb-2">
        <img src="{{ asset('storage/' . $post->logo) }}" class="card-img-top" alt="Post Image">

        <div class="card-body">
            <div class="d-flex align-items-center mb-2">
                <h3 class="card-title mb-0">{{ $post['title'] }}</h3>
                <h5 class="card-subtitle mb-0 text-muted ms-2">
                    <i><small>{{ $post['workType'] }}</small></i>
                </h5>
            </div>
            <h5 class="card-subtitle mb-2 text-muted">
                <small>{{ $post['location'] }}</small> <i class="material-icons">location_on</i>
            </h5>
            <p class="card-text">{{ $post['description'] }}</p>
            <div class="d-flex gap-2 mt-3">

                <a href="{{ route('posts.show', $post['id']) }}" class="btn btn-primary">Read More</a>
            </div>
        </div>

        <div class="card-footer text-muted">
            Posted on {{ Carbon::parse($post['updated_at'])->format('d M Y, h:i A') }}, by {{ $post->user->name }}
        </div>
    </div>
</div>

@endforeach

@else
<h1 class="text-center mt-5 p-4"
    style="background-color: #f8d7da; color: #721c24; border-radius: 5px; border: 1px solid #f5c6cb; width: 70%; margin: 0 auto;">
    There are no posts available.
</h1>

@endif
<script>
setTimeout(function() {
    documen
    t.getElementById('flash-message').style.display = 'none';
}, 1000);
</script>
<script src="{{ mix('js/app.js') }}"></script>

@endsection
