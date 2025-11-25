{{-- Password Reset Button Example --}}
<a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm" title="View">
    <i class="bi bi-eye"></i>
</a>
<form action="{{ route('users.reset-password', $user->id) }}" method="POST" class="d-inline ms-1">
    @csrf
    <button type="submit" class="btn btn-warning btn-sm" title="Reset Password">
        <i class="bi bi-key"></i> Reset Password
    </button>
</form>
