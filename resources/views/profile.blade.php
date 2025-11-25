@extends('layouts.admin')

@section('title', 'User Profile')

@section('page-title', 'User Profile')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            
            <!-- User Profile Card -->
            <div class="col-md-4">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">User Profile</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid rounded-circle shadow"
                                src="#"
                                alt="Profile Photo" style="width: 120px; height: 120px; object-fit: cover;">
                        </div>
                        <h3 class="profile-username text-center">{{ $user->name }}</h3>
                        <p class="text-muted text-center">{{ $user->email }}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Role</b>
                                <span class="float-right">
                                    <span class="badge bg-success">{{ ucfirst($user->role->name) }}</span>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <b>Last API Usage</b>
                                {{-- inline php --}}
                                @php
                                    $lastToken = $user->getLastTokenUsage();
                                @endphp
                                @if ($lastToken)
                                    <span class="float-right">
                                        <small>
                                            {{ $lastToken->name }}<br>
                                            <span
                                                class="text-muted">{{ $lastToken->last_used_at->format('M j, Y g:i A') }}</span>
                                        </small>
                                    </span>
                                @else
                                    <span class="float-right text-muted">Never used</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- API Token Management Card -->
            <div class="col-md-8">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">API Token Management</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="bi bi-dash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- displaying token once --}}
                        @if (session('new_token'))
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close">
                                </button>
                                <h5><i class="bi bi-key"></i> Your New API Token</h5>
                                <p class="mb-2"><strong>Save this token - you won't see it again!</strong></p>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ session('new_token') }}"
                                        id="newToken" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" onclick="copyToken()">
                                            <i class="bi bi-clipboard"></i> Copy
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- new token form --}}
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Generate New Token</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('profile.tokens.generate') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="token_name" class="form-label">Token Name *</label>
                                        <input type="text" class="form-control @error('token_name') is-invalid @enderror"
                                            id="token_name" name="token_name"
                                            value="{{ old('token_name', 'My API Token') }}" placeholder="Enter token name"
                                            required>
                                        @error('token_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Permissions</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="abilities[]"
                                                value="read" id="ability_read" checked>
                                            <label class="form-check-label" for="ability_read">
                                                Read
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="abilities[]"
                                                value="write" id="ability_write" checked>
                                            <label class="form-check-label" for="ability_write">
                                                Write
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="abilities[]"
                                                value="delete" id="ability_delete">
                                            <label class="form-check-label" for="ability_delete">
                                                Delete
                                            </label>
                                        </div>
                                        <small class="form-text text-muted">
                                            Leave all unchecked for full access (*)
                                        </small>
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-plus-circle"></i> Generate Token
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- show existing user tokens --}}
                        <div class="card card-warning mt-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Your Existing Tokens</h3>
                                @if ($tokens->count() > 0)
                                    <form method="POST" action="{{ route('profile.tokens.revoke-all') }}"
                                        onsubmit="return confirm('Are you sure you want to revoke ALL tokens?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash-fill"></i> Revoke All
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <div class="card-body p-0">
                                @if ($tokens->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Token Name</th>
                                                    <th>Abilities</th>
                                                    <th>Created</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tokens as $token)
                                                    <tr>
                                                        <td>
                                                            <strong>{{ $token->name }}</strong>
                                                        </td>
                                                        <td>
                                                            @foreach ($token->abilities as $ability)
                                                                <span class="badge bg-info">{{ $ability }}</span>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            <small
                                                                class="text-muted">{{ $token->created_at->format('M j, Y g:i A') }}</small>
                                                        </td>
                                                        <td>
                                                            <form method="POST"
                                                                action="{{ route('profile.tokens.revoke', $token->id) }}"
                                                                onsubmit="return confirm('Revoke this token?')"
                                                                class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                    <i class="bi bi-trash"></i> Revoke
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center p-4">
                                        <i class="fas fa-key fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">No API tokens generated yet.</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        // copy token to clipboard
        function copyToken() {
            const tokenInput = document.getElementById('newToken');
            tokenInput.select();
            tokenInput.setSelectionRange(0, 99999);
            document.execCommand('copy');
            // Show temporary feedback
            const button = event.target;
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-check"></i> Copied!';
            button.classList.remove('btn-outline-secondary');
            button.classList.add('btn-success');
            setTimeout(() => {
                button.innerHTML = originalText;
                button.classList.remove('btn-success');
                button.classList.add('btn-outline-secondary');
            }, 2000);
        }
       
    </script>
@endpush
