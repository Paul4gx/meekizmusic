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
            <form action="{{ route('admin.beats.update', $beat) }}" method="POST" enctype="multipart/form-data">
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
                                    <option value="draft" {{ old('status', $beat->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status', $beat->status) == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="archived" {{ old('status', $beat->status) == 'archived' ? 'selected' : '' }}>Archived</option>
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
@endsection 