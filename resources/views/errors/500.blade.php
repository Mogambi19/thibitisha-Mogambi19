@extends('layouts.admin')
@section('title', '500 Server Error')
@section('content')
<div class="container text-center mt-5">
    <h1 class="display-1">500</h1>
    <h2>Server Error</h2>
    <p>Whoops! Something went wrong on our servers.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go Home</a>
</div>
@endsection
