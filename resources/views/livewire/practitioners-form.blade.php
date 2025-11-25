<div class="card card-primary card-outline mb-4">
    <div class="card-header">
        <h5>{{ $isEditing ? 'Edit' : 'Add New' }} Practitioner</h5>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
            <div class="mb-3">
                <label class="form-label">Registration Number</label>
                <input type="text" class="form-control" wire:model="registration_number" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control @error('full_name') is-invalid @enderror" wire:model.blur="full_name" placeholder="Enter full name">
                @error('full_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Photo</label>
                <input type="file" class="form-control @error('profile_photo_url') is-invalid @enderror" wire:model="profile_photo_url">
                <div wire:loading wire:target="profile_photo_url">
                    <small class="text-muted">Uploading...</small>
                </div>
                @if ($profile_photo_url)
                    <div class="mt-2">
                        <label class="form-label">Preview:</label>
                        <div>
                            @if(is_object($profile_photo_url))
                                <img src="{{ $profile_photo_url->temporaryUrl() }}" class="img-thumbnail" width="150">
                            @elseif($profile_photo_url)
                                <img src="{{ asset('storage/' . $profile_photo_url) }}" class="img-thumbnail" width="150">
                            @endif
                        </div>
                    </div>
                @endif
                @error('profile_photo_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-select @error('status_id') is-invalid @enderror" wire:model="status_id">
                    <option value="">Select Status</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
                @error('status_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Speciality</label>
                <select class="form-select" wire:model.live="specialityId">
                    <option value="">Select Speciality</option>
                    @foreach ($specialities as $speciality)
                        <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($specialityId)
                <div class="mb-3">
                    <label class="form-label">Sub Speciality</label>
                    <select wire:key="subSpeciality-{{ $specialityId }}" class="form-select" wire:model="subSpecialityId">
                        <option value="">Select Sub Speciality</option>
                        @if ($subSpecialities)
                            @foreach ($subSpecialities as $subSpeciality)
                                <option value="{{ $subSpeciality->id }}">{{ $subSpeciality->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            @endif
            <div class="mb-3">
                <label class="form-label">Academic Qualifications</label>
                @foreach ($qualifications_array as $index => $qualification)
                    <div class="card mb-2" wire:key="qualification-{{ $index }}">
                        <div class="card-body">
                            <div class="mb-2">
                                <label class="form-label">Degree</label>
                                <select class="form-select" wire:model="qualifications_array.{{ $index }}.degree_id">
                                    <option value="">Select Degree</option>
                                    @foreach ($degrees as $degree)
                                        <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Institution</label>
                                <select class="form-select" wire:model="qualifications_array.{{ $index }}.institution_id">
                                    <option value="">Select Institution</option>
                                    @foreach ($institutions as $institution)
                                        <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Year Awarded</label>
                                <input type="number" min="1900" max="{{ date('Y') }}" class="form-control" wire:model="qualifications_array.{{ $index }}.year_awarded" placeholder="Enter year">
                            </div>
                            <button type="button" class="btn btn-danger btn-sm" wire:click="removeQualification({{ $index }})">Remove</button>
                        </div>
                    </div>
                @endforeach
                <button type="button" class="btn btn-success btn-sm" wire:click="addQualification">Add Qualification</button>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="store,update">
                        {{ $isEditing ? 'Update' : 'Create' }}
                    </span>
                    <span wire:loading wire:target="store,update">
                        <span class="spinner-border spinner-border-sm"></span> Saving...
                    </span>
                </button>
                <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
            </div>
        </form>
    </div>
</div>
