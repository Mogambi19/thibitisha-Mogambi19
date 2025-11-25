@extends('layouts.admin')

@section('title', 'Roles Management')
@section('page-title', 'Roles')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Roles</li>
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Roles</h3>
        <div class="card-tools">
          <a href="#" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add New Role
          </a>
        </div>
      </div>
      <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Role Name</th>
                <th>Description</th>
                <th>Users Count</th>
                <th>Created At</th>
                <th style="width: 200px">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($roles as $role)
                <tr>
                  <td>{{ $loop->iteration + ($roles->currentPage() - 1) * $roles->perPage() }}</td>
                  <td>{{ $role->name }}</td>
                  <td>{{ $role->description }}</td>
                  <td>
                    <span class="badge bg-success">{{ $role->users_count ?? $role->users()->count() }}</span>
                  </td>
                  <td>{{ $role->created_at ? $role->created_at->format('F d, Y') : '' }}</td>
                  <td>
                    <div class="btn-group" role="group">
                      <a href="{{ route('roles.show', $role) }}" class="btn btn-info btn-sm" title="View">
                        <i class="bi bi-eye"></i>
                      </a>
                      <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning btn-sm" title="Edit">
                        <i class="bi bi-pencil"></i>
                      </a>
                      <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this role?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                          <i class="bi bi-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center">No roles found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          <div class="mt-3">
            {{ $roles->links() }}
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script>
  // Add any page-specific JavaScript here
  console.log('Roles index page loaded');
  setTimeout(function() {
    document.querySelectorAll('.alert').forEach(function(alert) {
      let bsAlert = new bootstrap.Alert(alert);
      bsAlert.close();
    });
  }, 5000);
</script>
@endpush
