@php
use App\Models\User;
@endphp
@php($title = 'Manage Users')
@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<div class="admin-users">
    <div class="admin-card">
        <div class="admin-card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                @if ($user->profile_photo_path)
                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" style="width:100px;height:100px;" class="admin-user-avatar">
                            @else
                                <i class="la la-user-circle me-2" style="color:black; font-size:2rem;"></i>
                            @endif

                        </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $user->is_active ? 'success' : 'danger' }}">
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-{{ $user->is_active ? 'warning' : 'success' }}">
                                            <i class="fas fa-{{ $user->is_active ? 'ban' : 'check' }}"></i>
                                        </button>
                                    </form>
                                    @if($user->role !== 'admin' || User::where('role', 'admin')->count() > 1)
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links('vendor.pagination.custom') }}

        </div>
    </div>
</div>
@endsection 