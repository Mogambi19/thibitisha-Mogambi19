@extends('layouts.admin')

{{-- Page Title in Browser Tab --}}
@section('title', 'Statuses')

{{-- Page Heading --}}
@section('page-title', 'Statuses')

{{-- Breadcrumb --}}
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Statuses</li>
@endsection

{{-- Main Content --}}
@section('content')
    <div class="row">
        <livewire:statuses />
    </div>
@endsection

{{-- Page-specific Scripts --}}
@push('scripts')
    @livewireScripts()
    <script>
        // Add any page-specific JavaScript here
        console.log('Statuses index page loaded');
        // Example: Auto-hide alerts after 5 seconds
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
@endpush

{{-- page specific styles --}}
@push('styles')
    @livewireStyles()
@endpush
