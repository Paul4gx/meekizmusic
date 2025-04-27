@php($title = 'Manage Beats')
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
    <div class="row dz-tooltip-blog wow fadeInUp" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                        @forelse($beats as $beat)
                        <div class="col-12">
                            <div class="dz-card style-4">
                                <div class="row dz-info justify-content-between">
                                    <div class="col-lg-1 d-flex justify-content-center align-items-center">
                                        <img src="{{ Storage::url($beat->cover_image) }}" class="border border-black" style="opacity: 0.5">
                                        @if($beat->preview_url)
                                        {{-- <i class="fas fa-play text-danger" style="cursor:pointer;position: absolute;"></i> --}}
                                        @endif
                                    </div>
                                    <div class="col-lg-2">
                                        <span class="small-title">Duration:</span>
                                        <h5 class="dz-title"><a>{{ $beat->duration }} Mins</a></h5>
                                        <span class="small-title">{{ $beat->bpm }} BPM</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <h5 class="dz-title"><a>{{ $beat->title }}</a></h5>
                                        <span class="small-title">uploaded on {{ $beat->created_at->format('M d, Y') }}</span><br>
                                        @foreach($beat->genres as $genre)
                                        <span class="badge bg-secondary me-1">{{ $genre->name }}</span>
                                        
                                    @endforeach
                                    </div>
                                    <div class="col-lg-2">
                                        <span class="small-title">Amount:</span>
                                        <h5 class="dz-title"><a>{{currency_symbol()}}{{ number_format($beat->price, 2) }}</a></h5>
                                        
                                    </div>
                                    <div class="col-lg-2">
                                        <span class="small-title">Status:</span><br>
                                        <span class="badge bg-{{ $beat->status === 'published' ? 'success' : ($beat->status === 'draft' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst($beat->status) }}
                                        </span>
                                        
                                    </div>
                                    <div class="col-lg-1">
                                        <span class="small-title">Action:</span>
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
                        @empty
                                <p class="text-center">No beats found.</p>
                        @endforelse
            </div>

            {{ $beats->links('vendor.pagination.custom') }}

        </div>
    </section>
@endsection 