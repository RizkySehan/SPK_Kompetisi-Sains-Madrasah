@extends('partials.app')

@section('title', 'Input Score | KSM')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 fw-bold">Student Score Input</h2>
        @if (auth()->user()->role === 'homeroom-teacher')
        <div class="flex justify-between items-center gap-2">
            <form id="generate-result-form" action="{{ route('homeroom-teacher.results.generate') }}" method="POST">
                @csrf
                <button type="button" class="btn btn-primary text-white font-bold" onclick="confirmGenerate()">Calculate Result</button>
            </form>
            {{-- <form method="POST" action="{{ route('homeroom-teacher.set.subject') }}" class="mb-4">
                @csrf
                <label for="subject" class="font-semibold">Mapel yang dinilai (C1):</label>
                <select name="subject" id="subject" class="border rounded p-2">
                    <option value="Matematika" {{ session('subject') === 'Matematika' ? 'selected' : '' }}>Matematika</option>
                    <option value="Geografi" {{ session('subject') === 'Geografi' ? 'selected' : '' }}>Geografi</option>
                    <option value="Ekonomi" {{ session('subject') === 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                </select>
                <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-1 rounded">Set</button>
            </form> --}}
            <form id="delete-form-all" action="{{ route('homeroom-teacher.scores.destroyAll') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger text-white font-bold" onclick="confirmDeleteAll()">
                    Delete All Value
                </button>
            </form>
        </div>
        @endif
    </div>

    <div>
        <table id="example" class="display">
            <thead class="table-light fw-bold">
                <tr class="text-center">
                    <th>No</th>
                    <th>Name</th>
                    <th>C1<br>Nilai PAT Mapel KSM</th>
                    <th>C2<br>Nilai Rata-Rata PAI</th>
                    <th>C3<br>Nilai Akhlak</th>
                    <th>C4<br>Rangking Top 10</th>
                    <th>C5<br>Absensi</th>
                    @if (!in_array(Auth::user()->role, ['administration','headmaster', 'ksm-teacher']))
                        <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $index => $student)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $student->name }}</td>
                        @for ($i = 1; $i <= 5; $i++)
                            @php
                                $score = $student->scores->where('criteria_id', $i)->first();
                            @endphp
                            <td class="text-center">
                                {{ $score?->value ?? '-' }}
                            </td>
                        @endfor
                        @if (!in_array(Auth::user()->role, ['administration','headmaster', 'ksm-teacher']))
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-warning text-white font-bold"
                                    data-bs-toggle="modal" data-bs-target="#editScoreModal{{ $student->id }}">
                                    Edit
                                </button>
                                @include('homeroom-teacher.scores.edit', ['student' => $student, 'criterias' => $criterias])
                                <form id="delete-form-{{ $student->id }}" action="{{ route('homeroom-teacher.scores.deleteByStudent', $student->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger text-white font-bold" onclick="confirmDelete({{ $student->id }})">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No students data available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@include('partials.alert')
