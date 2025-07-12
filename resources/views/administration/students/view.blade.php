@extends('partials.app')

@section('title', 'Student Data | KSM')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 fw-bold">Student Management</h2>
         @if (auth()->user()->role === 'administration')
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal" class="fw-bold">
            <span class="fw-bold">Add Student</span>
        </button>
        @endif
        @include('administration.students.create')
    </div>

    <div>
        <table id="example" class="display">
            <thead class="table-light fw-bold">
                <tr class="text-center">
                    <th>No</th>
                    <th>Name</th>
                    <th>NISN</th>
                    <th>Date of Birth</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Class</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $index => $student)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->nisn }}</td>
                        <td>{{ $student->tgl_lahir }}</td>
                        <td>{{ $student->tlp }}</td>
                        <td>{{ $student->jk }}</td>
                        <td>{{ $student->address }}</td>
                        <td>{{ $student->class }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                @if (auth()->user()->role === 'homeroom-teacher')
                                    <!-- Tombol Input Nilai -->
                                    <button type="button" class="btn btn-success btn-sm fw-bold"
                                        data-bs-toggle="modal" data-bs-target="#inputScoreModal{{ $student->id }}">
                                        Value Input
                                    </button>

                                    @include('homeroom-teacher.scores.create', ['student' => $student, 'criterias' => $criterias])
                                @else
                                    <!-- Tombol Edit -->
                                    <button type="button" class="btn btn-sm btn-warning text-white font-bold"
                                        data-bs-toggle="modal" data-bs-target="#editStudentModal{{ $student->id }}">
                                        Edit
                                    </button>

                                    @include('administration.students.edit')

                                    <!-- Tombol Hapus -->
                                    <form id="delete-form-{{ $student->id }}" 
                                        action="{{ route('administration.students.destroy', $student->id) }}" 
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger text-white font-bold" 
                                                onclick="confirmDelete({{ $student->id }})">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No Students data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@include('partials.alert')