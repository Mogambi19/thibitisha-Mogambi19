@if ($showView)
    <div class="card card-info card-outline mb-4">
        <div class="card-header">
            <h5>Practitioner Details</h5>
        </div>
        <div class="card-body">
            <p><strong>Full Name:</strong> {{ $full_name }}</p>
            <p><strong>Registration Number:</strong> {{ $registration_number }}</p>
            <p><strong>Status:</strong> {{ $status }}</p>
            <p><strong>Speciality:</strong> {{ $speciality }}</p>
            <p><strong>Sub Speciality:</strong> {{ $sub_speciality }}</p>
            @if ($profile_photo_url)
                <p><strong>Photo:</strong></p>
                <img src="{{ asset('storage/' . $profile_photo_url) }}" class="img-thumbnail" width="150">
            @endif
            <h5 class="mt-3">Contact Details</h5>
            @if ($contacts && $contacts->count() > 0)
                <ul>
                    @foreach ($contacts as $contact)
                        <li>{{ $contact->type }}: {{ $contact->value }}</li>
                    @endforeach
                </ul>
            @else
                <p>No contact details available.</p>
            @endif
            <h5>Academic Qualifications</h5>
            @if ($qualifications && $qualifications->count() > 0)
                <ul>
                    @foreach ($qualifications as $qualification)
                        <li>
                            {{ $qualification->degree->name }} from {{ $qualification->institution->name }} ({{ $qualification->year_awarded }})
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No qualifications available.</p>
            @endif
            <div class="mt-3">
                <button wire:click="closeView" class="btn btn-secondary">Close</button>
            </div>
        </div>
    </div>
@endif
