@extends('layouts.admin')
@section('title', '404 Not Found')
@section('content')
<div class="container text-center mt-5">
    <h1 class="display-1">404</h1>
    <h2>Page Not Found</h2>
    <p>The page you are looking for could not be found.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go Home</a>
</div>
@endsection
