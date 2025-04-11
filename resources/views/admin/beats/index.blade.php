@extends('layouts.admin')

@section('title', 'Manage Beats')

@section('content')
<section class="content-inner-2 pt-0">
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('admin.beats.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Beat
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('preview_generating'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle"></i> Preview generation is in progress. The preview will be available shortly.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row dz-tooltip-blog wow fadeInUp" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                        @forelse($beats as $beat)
                        <div class="col-12">
                            <div class="dz-card style-4">
                                <div class="row dz-info justify-content-between">
                                    <div class="col-lg-1 d-flex justify-content-center align-items-center">
                                        <img src="{{ Storage::url($beat->cover_image) }}" class="border border-black" style="opacity: 0.5">
                                        @if($beat->preview_url)
                                        <i class="fas fa-play text-danger" style="cursor:pointer;position: absolute;"></i>
                                        @endif
                                    </div>
                                    <div class="col-lg-2">
                                        <h5 class="dz-title"><a>{{ $beat->duration }} Mins</a></h5>
                                        <span class="small-title">{{ $beat->bpm }} BPM</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <h5 class="dz-title"><a>{{ $beat->title }}</a></h5>
                                        @foreach($beat->genres as $genre)
                                        <span class="badge bg-secondary me-1">{{ $genre->name }}</span>
                                        <span class="small-title">uploaded on {{ $beat->created_at->format('M d, Y') }}</span>
                                    @endforeach
                                    </div>
                                    <div class="col-lg-2">
                                        <h5 class="dz-title"><a>${{ number_format($beat->price, 2) }}</a></h5>
                                        
                                    </div>
                                    <div class="col-lg-2">
                                        <span class="badge bg-{{ $beat->status === 'published' ? 'success' : ($beat->status === 'draft' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst($beat->status) }}
                                        </span>
                                        
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.beats.edit', $beat) }}" 
                                               class="btn btn-sm">
                                                <i class="fas fa-edit text-info"></i>
                                            </a>
                                            <form action="{{ route('admin.beats.destroy', $beat) }}" method="POST" 
                                                  class="d-inline" onsubmit="return confirm('Are you sure you want to delete this beat?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            {{-- <tr>
                                <td></td>
                                <td>{{ $beat->artist }}</td>
                                <td>
                                    
                                </td>
                                <td>
                                      
                                </td>
                                <td>
                                    @if($beat->preview_url)
                                        <button class="btn btn-sm btn-outline-primary preview-btn" 
                                                data-preview-url="{{ Storage::url($beat->preview_url) }}"
                                                data-title="{{ $beat->title }}"
                                                data-artist="{{ $beat->artist }}"
                                                data-cover="{{ Storage::url($beat->cover_image) }}">
                                            <i class="fas fa-play"></i> Preview
                                        </button>
                                    @else
                                        <span class="text-muted">Preview generating...</span>
                                    @endif
                                </td>
                                <td>
                                    
                                </td>
                            </tr> --}}
                        @empty
                                <p class="text-center">No beats found.</p>
                        @endforelse
            </div>

            <div class="mt-4">
                {{ $beats->links() }}
            </div>
        </div>
    </section>


@include('components.audio-player')
@endsection 