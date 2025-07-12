@extends('partials.app')

@section('title', 'User Data | KSM')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 fw-bold">User Management</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <span class="fw-bold">Add User</span>
        </button>
        @include('administration.user_management.create')
    </div>

    <div>
        <table id="example" class="display">
            <thead class="table-light fw-bold">
                <tr class="text-center">
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-capitalize">{{ str_replace('_', ' ', $user->role) }}</td>
                        <td>
                            <span class="badge bg-{{ $user->active ? 'success' : 'danger' }}">
                                {{ $user->active ? 'Active' : 'Nonactive' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <!-- Tombol Edit -->
                                <button type="button" class="btn btn-sm btn-warning text-white font-bold"
                                    data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                     Edit
                                </button>
                                
                                @include('administration.user_management.edit')
                                <!-- Tombol Hapus -->
                                <form id="delete-form-{{ $user->id }}" action="{{ route('administration.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger text-white font-bold" onclick="confirmDelete({{ $user->id }})">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No users data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@include('partials.alert')