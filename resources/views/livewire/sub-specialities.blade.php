<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All SubSpecialities</h3>
            <div class="card-tools">
                <a href="#" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle"></i> Add New Sub Speciality
                </a>
                <form class="d-inline-block me-2">
                    <div class="input-group input-group-sm">
                        <input wire:model.live.debounce.200ms="search" type="text" name="search"
                            class="form-control @error('search') is-invalid @enderror"
                            title="@error('search') Error: may only contain letters and spaces @enderror"
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
                            <a href="#" wire:click="orderBy('name')">Name</a>
                            @if($orderDirection == "asc")
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
                            <td>{{ $subspeciality->speciality->name }}</td>
                            <td>{{ date('M d, Y', strtotime($subspeciality->created_at)) }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-info btn-sm" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="#" method="POST" class="d-inline"
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
</div>
