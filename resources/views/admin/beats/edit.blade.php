@php($title = 'Edit Beat')
@extends('layouts.admin')

@section('title', 'Edit Beat')

@section('content')
<section class="content-inner-2 pt-0">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('admin.beats.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Beats
            </a>
        </div>
            <form action="{{ route('admin.beats.update', $beat) }}" id="beatForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <!-- Basic Information -->
                        <div class="mb-4">
                            <h4>Basic Information</h4>
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title', $beat->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="4" required>{{ old('description', $beat->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price ($)</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                               id="price" name="price" value="{{ old('price', $beat->price) }}" step="0.01" required>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="bpm" class="form-label">BPM</label>
                                        <input type="number" class="form-control @error('bpm') is-invalid @enderror" 
                                               id="bpm" name="bpm" value="{{ old('bpm', $beat->bpm) }}" min="0">
                                        @error('bpm')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="duration" class="form-label">Duration</label>
                                <input type="text" class="form-control @error('duration') is-invalid @enderror" 
                                       id="duration" name="duration" value="{{ old('duration', $beat->duration) }}" placeholder="e.g., 3:45">
                                @error('duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Genres -->
                        <div class="mb-4">
                            <h4>Genres</h4>
                            <div class="mb-3">
                                <label class="form-label">Select Genres</label>
                                <div class="row">
                                    @foreach($genres as $genre)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="genre_ids[]" value="{{ $genre->id }}" 
                                                   id="genre{{ $genre->id }}"
                                                   {{ in_array($genre->id, old('genre_ids', $beat->genres->pluck('id')->toArray())) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="genre{{ $genre->id }}">
                                                {{ $genre->name }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @error('genre_ids')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Files -->
                        <div class="mb-4">
                            <h4>Files</h4>
                            <div class="mb-3">
                                <label for="audio_file" class="form-label">Audio File</label>
                                <input type="file" class="form-control @error('audio_file') is-invalid @enderror" 
                                       id="audio_file" name="audio_file" accept=".mp3,.wav">
                                <div class="form-text">Supported formats: MP3, WAV. Max size: 10MB</div>
                                @error('audio_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($beat->file_url)
                                    <div class="mt-2">
                                        <audio controls class="w-100">
                                            <source src="{{ Storage::url($beat->file_url) }}" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </div>
                                @endif
                                                                <!-- Audio Preview -->
                                                                <div id="audio-processing" class="mt-2 text-muted d-none">
                                                                    <div class="spinner-border spinner-border-sm" role="status"></div>
                                                                    Processing audio...
                                                                </div>
                                                                <audio id="audioPreview" controls class="mt-2 d-none" style="width: 100%"></audio>
                                                                <input type="hidden" name="trimmed_audio" id="trimmedAudio">
                                                                    <!-- Hidden file input for trimmed audio -->
                                                                <input type="file" id="trimmedAudioFile" name="trimmed_audio_file" class="d-none" accept=".wav">
                            </div>

                            <div class="mb-3">
                                <label for="cover_image" class="form-label">Cover Image</label>
                                <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                                       id="cover_image" name="cover_image" accept="image/*">
                                <div class="form-text">Recommended size: 500x500px. Max size: 2MB</div>
                                @error('cover_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($beat->cover_image)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($beat->cover_image) }}" alt="Current cover" class="img-thumbnail" style="max-height: 200px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Status and Featured -->
                        <div class="mb-4">
                            <h4>Status</h4>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" name="status" required>
                                    {{-- <option value="draft" {{ old('status', $beat->status) == 'draft' ? 'selected' : '' }}>Draft</option> --}}
                                    {{-- <option value="published" {{ old('status', $beat->status) == 'published' ? 'selected' : '' }}>Published</option> --}}
                                    <option value="published" selected>Published</option>
                                    {{-- <option value="archived" {{ old('status', $beat->status) == 'archived' ? 'selected' : '' }}>Archived</option> --}}
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="is_featured" 
                                           name="is_featured" value="1" {{ old('is_featured', $beat->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">Featured Beat</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Beat
                    </button>
                </div>
            </form>
        </div>
    </section>
    
    <script>
        // Modified form submission handler
        document.getElementById('beatForm').addEventListener('submit', function(e) {
            if (!window.trimmedAudioBlob) {
                alert("Please wait for audio processing to complete");
                e.preventDefault();
                return;
            }
            
            // Convert blob to File object and assign to hidden input
            const previewFile = new File([window.trimmedAudioBlob], 'preview.wav', {
                type: 'audio/wav',
                lastModified: Date.now()
            });
            
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(previewFile);
            document.getElementById('trimmedAudioFile').files = dataTransfer.files;
            
            // Form will now submit normally with both files
        });
    </script>
  <script>
document.addEventListener('DOMContentLoaded', function() {
    const audioFileInput = document.getElementById('audio_file');
    const audioPreview = document.getElementById('audioPreview');
    const processingIndicator = document.getElementById('audio-processing');
    let audioContext;
    let audioBuffer;

    // Initialize audio context on user interaction
    audioFileInput.addEventListener('click', function() {
        if (!audioContext) {
            audioContext = new (window.AudioContext || window.webkitAudioContext)();
        }
    });

    audioFileInput.addEventListener('change', async function(e) {
        const file = e.target.files[0];
        if (!file) return;

        // Reset UI
        audioPreview.classList.add('d-none');
        processingIndicator.classList.remove('d-none');
        
        try {
            // Read and decode the file
            const arrayBuffer = await file.arrayBuffer();
            audioBuffer = await audioContext.decodeAudioData(arrayBuffer);
            
            // Create preview (first 30 seconds with fade)
            const previewBlob = await createAudioPreview(audioBuffer, file.type);
            
            // Play preview
            playAudioPreview(previewBlob);
            
            // Store for form submission
            window.trimmedAudioBlob = previewBlob;
            
        } catch (error) {
            console.error("Audio processing error:", error);
            alert("Error processing audio. Please try another file.");
        } finally {
            processingIndicator.classList.add('d-none');
        }
    });

    // Form submission handler
    document.getElementById('beatForm').addEventListener('submit', function(e) {
        if (!window.trimmedAudioBlob) {
            alert("Please wait for audio processing to complete");
            e.preventDefault();
            return;
        }
        
        // Convert blob to base64 for form submission
        const reader = new FileReader();
        reader.onload = () => {
            document.getElementById('trimmedAudio').value = reader.result;
        };
        reader.onerror = () => {
            alert("Error preparing audio for upload");
            e.preventDefault();
        };
        reader.readAsDataURL(window.trimmedAudioBlob);
    });

    // Audio processing functions
    async function createAudioPreview(buffer, mimeType = 'audio/wav') {
        const trimDuration = Math.min(30, buffer.duration);
        const fadeDuration = 0.5; // 0.5 second fade-out
        
        // Create new buffer for preview
        const previewBuffer = audioContext.createBuffer(
            buffer.numberOfChannels,
            trimDuration * buffer.sampleRate,
            buffer.sampleRate
        );
        
        // Copy data with fade-out
        for (let channel = 0; channel < buffer.numberOfChannels; channel++) {
            const channelData = buffer.getChannelData(channel);
            const previewData = previewBuffer.getChannelData(channel);
            
            const copyLength = Math.min(channelData.length, previewData.length);
            const fadeStartSample = (trimDuration - fadeDuration) * buffer.sampleRate;
            
            for (let i = 0; i < copyLength; i++) {
                let sample = channelData[i];
                
                // Apply fade-out if in the fade region
                if (i >= fadeStartSample) {
                    const fadePosition = (i - fadeStartSample) / (fadeDuration * buffer.sampleRate);
                    sample = sample * (1 - fadePosition); // Linear fade
                }
                
                previewData[i] = sample;
            }
        }
        
        // Convert to Blob
        return await audioBufferToBlob(previewBuffer, mimeType);
    }

    function audioBufferToBlob(buffer, mimeType) {
        return new Promise((resolve) => {
            // Convert to WAV format (works for all browsers)
            const wavBuffer = encodeWAV(buffer);
            resolve(new Blob([wavBuffer], { type: mimeType }));
        });
    }

    function playAudioPreview(blob) {
        const url = URL.createObjectURL(blob);
        audioPreview.src = url;
        audioPreview.classList.remove('d-none');
        audioPreview.play().catch(e => {
            console.log("Autoplay prevented, user must click play:", e);
        });
    }

    // WAV encoder helper functions
    function encodeWAV(buffer) {
        const numChannels = buffer.numberOfChannels;
        const sampleRate = buffer.sampleRate;
        const bytesPerSample = 2;
        const blockAlign = numChannels * bytesPerSample;
        const byteRate = sampleRate * blockAlign;
        const dataSize = buffer.length * blockAlign;
        
        const bufferLength = 44 + dataSize;
        const view = new DataView(new ArrayBuffer(bufferLength));
        
        // RIFF identifier
        writeString(view, 0, 'RIFF');
        // RIFF chunk length
        view.setUint32(4, 36 + dataSize, true);
        // RIFF type
        writeString(view, 8, 'WAVE');
        // Format chunk identifier
        writeString(view, 12, 'fmt ');
        // Format chunk length
        view.setUint32(16, 16, true);
        // Sample format (raw PCM)
        view.setUint16(20, 1, true);
        // Channel count
        view.setUint16(22, numChannels, true);
        // Sample rate
        view.setUint32(24, sampleRate, true);
        // Byte rate (sample rate * block align)
        view.setUint32(28, byteRate, true);
        // Block align (channel count * bytes per sample)
        view.setUint16(32, blockAlign, true);
        // Bits per sample
        view.setUint16(34, bytesPerSample * 8, true);
        // Data chunk identifier
        writeString(view, 36, 'data');
        // Data chunk length
        view.setUint32(40, dataSize, true);
        
        // Write PCM samples
        const offset = 44;
        for (let i = 0; i < buffer.length; i++) {
            for (let channel = 0; channel < numChannels; channel++) {
                const sample = Math.max(-1, Math.min(1, buffer.getChannelData(channel)[i]));
                const int16 = sample < 0 ? sample * 32768 : sample * 32767;
                view.setInt16(offset + (i * blockAlign) + (channel * bytesPerSample), int16, true);
            }
        }
        
        return view;
    }

    function writeString(view, offset, string) {
        for (let i = 0; i < string.length; i++) {
            view.setUint8(offset + i, string.charCodeAt(i));
        }
    }
});
</script>
@endsection 