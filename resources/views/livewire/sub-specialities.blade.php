<div class="col-md-12">
    {{--  show messages --}}
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if ($showForm)
        {{-- form --}}
        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">{{ $isEditing ? "Edit " : "Add " }} Sub Speciality</div>
            </div>
            <form wire:submit.click="{{ $isEditing ? "update($id)" : "store" }}">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input required wire:model="name" type="name" name="name"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="speciality" class="form-label">Speciality</label>
                        <select name="speciality" class="form-control @error('speciality') is-invalid @enderror"
                            wire:model="speciality">
                            <option value=""> -- Please Select -- </option>
                            @foreach ($specialities as $speciality)
                                <option value="{{ $speciality->id }}">
                                    {{ $speciality->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('speciality')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi-icons bi-save"></i> {{$isEditing ? " Save Changes" : "Submit"}}
                    </button>
                    <a href="#" wire:click="cancel" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
            </form>
        </div>
    @else
        {{-- table --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All SubSpecialities</h3>
                <div class="card-tools">
                    <a href="#" wire:click="add" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Add New Sub Speciality
                    </a>
                    <form class="d-inline-block me-2">
                        <div class="input-group input-group-sm">
                            <input wire:model.live.debounce:200ms="search" type="text" name="search"
                                class="form-control {{ $errors->has('search') ? 'is-invalid' : '' }}"
                                title="{{ $errors->has('search') ? 'Error: may only contain letters and spaces' : '' }}"
                                placeholder="Search Specialities"
                                {{ request()->has('search') && trim(request('search')) !== '' ? 'autofocus' : '' }}>
                        </div>
                    </form>
                    <a href="#" wire:click="clearSearch" title="Reset" class="btn btn-success">
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
                                <a href="#" wire:click="orderBy('name')">
                                    Name
                                </a>
                                @if ($orderDirection == 'asc')
                                    <i class="bi bi-sort-alpha-up"></i>
                                @else
                                    <i class="bi bi-sort-alpha-down"></i>
                                @endif
                            </th>
                            <th>Speciality</th>
                            <th>Created At</th>
                            <th style="width: 200px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subspecialities as $subspeciality)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $subspeciality->name }}</td>
                                <td> {{ $subspeciality->speciality->name }} </td>
                                <td>{{ date('M d, Y', strtotime($subspeciality->created_at)) }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="#"  class="btn btn-info btn-sm" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="#" wire:click="edit({{ $subspeciality->id }})" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="#" wire:submit="destroy({{ $subspeciality->id }})" method="POST" class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this Sub Speciality?');">
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
                    {{ $subspecialities->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
