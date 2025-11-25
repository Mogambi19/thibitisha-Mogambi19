<div class="col-12">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($showForm)
        @include('livewire.practitioners-form')
    @elseif ($showView)
        @include('livewire.practitioners-view')
    @else
        <div class="card card-warning card-outline mb-4">
            <div class="card-header">
                <h3>Practitioners List</h3>
                <div class="card-tools d-flex gap-2">
                    <input wire:model.live.debounce.200ms="search" type="text" class="form-control" placeholder="Search Practitioners">
                    <div wire:loading wire:target="search">
                        <small class="text-muted">Searching...</small>
                    </div>
                    <button wire:click="clearSearch" class="btn btn-success btn-sm">Clear</button>
                    <button wire:click="add" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Add New Practitioner
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" wire:model.live="selectAll"></th>
                            <th>ID</th>
                            <th wire:click="sortBy('full_name')" style="cursor: pointer;">Name @if($orderField === 'full_name') @if($orderDirection === 'asc') ↑ @else ↓ @endif @endif</th>
                            <th wire:click="sortBy('registration_number')" style="cursor: pointer;">Reg. No. @if($orderField === 'registration_number') @if($orderDirection === 'asc') ↑ @else ↓ @endif @endif</th>
                            <th>Status</th>
                            <th>Speciality</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($practitioners as $practitioner)
                            <tr>
                                <td><input type="checkbox" wire:model.live="selectedPractitioners" value="{{ $practitioner->id }}"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $practitioner->full_name }}</td>
                                <td>{{ $practitioner->registration_number }}</td>
                                <td>{{ $practitioner->status->name ?? '' }}</td>
                                <td>{{ $practitioner->speciality->name ?? '' }}</td>
                                <td>
                                    <button wire:click="viewOne({{ $practitioner->id }})" class="btn btn-sm btn-info" title="View"><i class="bi bi-eye"></i> View</button>
                                    <button wire:click="edit({{ $practitioner->id }})" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i> Edit</button>
                                    @if ($practitioner->status->name !== 'ACTIVE')
                                        <button wire:click="activate({{ $practitioner->id }})" class="btn btn-sm btn-success" title="Activate"><i class="bi bi-check-circle"></i> Activate</button>
                                    @else
                                        <button wire:click="deactivate({{ $practitioner->id }})" class="btn btn-sm btn-secondary" title="Deactivate"><i class="bi bi-x-circle"></i> Deactivate</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No practitioners found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button wire:click="bulkActivate" class="btn btn-success btn-sm">Bulk Activate</button>
                <button wire:click="bulkDeactivate" class="btn btn-secondary btn-sm">Bulk Deactivate</button>
                <div class="float-end">
                    {{ $practitioners->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
