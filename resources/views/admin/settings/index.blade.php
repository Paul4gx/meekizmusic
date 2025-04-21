@extends('layouts.admin')

@section('title', 'Admin Settings')

@section('content')
<section class="content-inner-2 pt-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                    <div class="row">
                        <div class="col-md-9">
   
                            <div class="mb-3">
                                <label for="currency" class="form-label">Default Currency</label>
                                <input type="text" class="form-control @error('currency') is-invalid @enderror" 
                                       id="currency" name="currency" value="{{ old('currency', $settings?->currency ?? 'NGN') }}" 
                                        required>
                                @error('currency')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Contact Information</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="email" class="form-control @error('contact_info.email') is-invalid @enderror" 
                                               name="contact_info[email]" placeholder="Email" 
                                               value="{{ old('contact_info.email', $settings?->contact_info['email'] ?? '') }}" required>
                                        @error('contact_info.email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control @error('contact_info.phone') is-invalid @enderror" 
                                               name="contact_info[phone]" placeholder="Phone" 
                                               value="{{ old('contact_info.phone', $settings?->contact_info['phone'] ?? '') }}">
                                        @error('contact_info.phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <textarea class="form-control mt-2 @error('contact_info.address') is-invalid @enderror" 
                                          name="contact_info[address]" placeholder="Address">{{ old('contact_info.address', $settings?->contact_info['address'] ?? '') }}</textarea>
                                @error('contact_info.address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="next_beat_release" class="form-label">Next Beat Release Date</label>
                                <input type="datetime-local" class="form-control @error('next_beat_release') is-invalid @enderror" 
                                       id="next_beat_release" name="next_beat_release" 
                                       value="{{ old('next_beat_release', $settings?->next_beat_release ? $settings->next_beat_release->format('Y-m-d\TH:i') : '') }}">
                                @error('next_beat_release')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Search Suggestion Keywords</label>
                                <p class="text-muted small">Add keywords that will appear as suggestions when users search for beats.</p>
                                <div id="quick-search-container">
                                    @php
                                        $quickSearchWords = old('quick_search', $settings?->quick_search ?? []);
                                    @endphp
                                    @if(!empty($quickSearchWords))
                                        @foreach($quickSearchWords as $word)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="quick_search[]" value="{{ $word }}" placeholder="Keyword">
                                                <button type="button" class="btn btn-sm btn-danger remove-word"><i class="fas fa-remove"></i></button>
                                            </div>
                                        @endforeach
                                    @endif
                                    <!-- Add an empty input group by default -->
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="quick_search[]" placeholder="New Keyword">
                                        <button type="button" class="btn btn-sm btn-danger remove-word"><i class="fas fa-remove"></i></button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary mt-2" id="add-word">Add Another Keyword</button>
                            </div>
                        </div>

                            <button type="submit" class="col-12 btn btn-primary">Save Settings</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
</section>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('quick-search-container');
    const addButton = document.getElementById('add-word');

    // Function to add a new keyword input
    function addNewWordInput() {
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="text" class="form-control" name="quick_search[]" placeholder="e.g., Trap, Hip Hop, R&B">
            <button type="button" class="btn btn-danger remove-word"><i class="fas fa-remove"></i></button>
        `;
        container.appendChild(div);
    }

    // Add click event listener to the add button
    if (addButton) {
        addButton.addEventListener('click', addNewWordInput);
    }

    // Add click event listener to the container for remove buttons
    if (container) {
        container.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-word')) {
                const inputGroup = e.target.closest('.input-group');
                if (inputGroup) {
                    inputGroup.remove();
                }
            }
        });
    }
});
</script>
@endpush 