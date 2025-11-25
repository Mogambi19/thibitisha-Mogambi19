@extends('layouts.admin')

{{-- Page Title in Browser Tab --}}
@section('title', 'Specialities')

{{-- Page Heading --}}
@section('page-title', 'Specialities')

{{-- Breadcrumb --}}
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Specialities</li>
@endsection

{{-- Main Content --}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Specialities</h3>
                    <div class="card-tools">
                        <a href="{{ route('specialities.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle"></i> Add New Speciality
                        </a>

                        <form action="{{ route('specialities.index') }}" method="GET" class="d-inline-block me-2">
                            <div class="input-group input-group-sm">
                                {{--  show inline error messages --}}
                                <input type="text" name="search"
                                    class="form-control {{ $errors->has('search') ? 'is-invalid' : '' }}"
                                    title="{{ $errors->has('search') ? 'Error: may only contain letters and spaces' : '' }}"
                                    placeholder="Search Specialities" {{ (request()->has('search') && trim(request('search')) !== "") ? 'autofocus' : '' }} value="{{ old('search', request('search')) }}">
                                    <div class="input-group-append">
                                    <button title="Search" type="submit" class="btn btn-secondary">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <a href="{{ route('specialities.index') }}" title="Reset" class="btn btn-success">
                            <i class="bi bi-arrow-clockwise"></i> 
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>
                                    @sortablelink('name', 'Name')
                                </th>
                                <th>Sub Speciality Count</th>
                                <th>Created At</th>
                                <th style="width: 200px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($specialities as $speciality)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $speciality->name }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ $speciality->subSpecialities->count() }}</span>
                                    </td>
                                    <td>{{ date('M d, Y', strtotime($speciality->created_at)) }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('specialities.show', $speciality->id) }}" class="btn btn-info btn-sm"
                                                title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('specialities.edit', $speciality->id) }}" class="btn btn-warning btn-sm"
                                                title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('specialities.destroy', $speciality->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this Speciality?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{-- Pagination --}}
                    <div class="mt-3">
                        {{ $specialities->links('pagination::bootstrap-5') }}
                    </div> 
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

{{-- Page-specific Scripts --}}
@push('scripts')
    <script>
        // Add any page-specific JavaScript here
        console.log('Roles index page loaded');
        // Example: Auto-hide alerts after 5 seconds
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
@endpush
