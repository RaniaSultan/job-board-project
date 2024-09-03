@extends('layouts.app')

@section('title')
All Applications
@endsection

@section('main')
<div class="card">
  <div class="card-header">
    Applicant Name
  </div>
  <div class="card-body">
    <h5 class="card-title">Applicant jobTitle</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="{{--route('applications.show')--}}" class="btn btn-primary">Show Application</a>
  </div>
</div>
@endsection