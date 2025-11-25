@extends('layouts.admin')
@section('title', '403 Forbidden')
@section('content')
<div class="container text-center mt-5">
    <h1 class="display-1">403</h1>
    <h2>Forbidden</h2>
    <p>You do not have permission to access this resource.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go Home</a>
</div>
@endsection
