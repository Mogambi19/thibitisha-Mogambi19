@extends('layouts.admin')
@section('title', '419 Page Expired')
@section('content')
<div class="container text-center mt-5">
    <h1 class="display-1">419</h1>
    <h2>Page Expired</h2>
    <p>Your session has expired. Please refresh and try again.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go Home</a>
</div>
@endsection
