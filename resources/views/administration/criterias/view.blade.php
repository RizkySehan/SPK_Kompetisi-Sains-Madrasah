@extends('partials.app')

@section('title', 'Criteria MOORA | KSM')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 fw-bold">Criteria Manajemen</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCriteriaModal">
            <span class="fw-bold">Add Criteria</span>
        </button>
        @include('administration.criterias.create')
    </div>

    <div>
        <table id="example" class="display">
            <thead class="table-light fw-bold">
                <tr class="text-center">
                    <th>No</th>
                    <th>Code</th>
                    <th>Criteria Name</th>
                    <th>Weight</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($criterias as $index => $criteria)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $criteria->code }}</td>
                        <td>{{ $criteria->name }}</td>
                        <td class="text-center">{{ $criteria->bobot }}</td>
                        <td class="text-capitalize text-center">{{ ucfirst($criteria->type) }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                {{-- Tombol Edit --}}
                                <button type="button" class="btn btn-sm btn-warning text-white font-bold"
                                    data-bs-toggle="modal" data-bs-target="#editCriteriaModal{{ $criteria->id }}">
                                     Edit
                                </button>
                                @include('administration.criterias.edit')
                                
                                {{-- Tombol Hapus --}}
                                <form id="delete-form-{{ $criteria->id }}" action="{{ route('administration.criterias.destroy', $criteria->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger text-white font-bold" onclick="confirmDelete({{ $criteria->id }})">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No Criterias Data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@include('partials.alert')