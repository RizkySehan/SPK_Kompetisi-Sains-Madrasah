@extends('partials.app')

@section('title', 'Calculate Result')

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if($noResultYet)
    <div class="alert alert-warning" role="alert">
        <strong>Notice:</strong> No results have been calculated by the homeroom teacher yet.
    </div>
@endif

<div class="container py-4">
    {{-- @if(session('subject'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow">
            <strong>Informasi:</strong> Saat ini penilaian untuk kriteria <strong>C1</strong> adalah mapel:
            <span class="font-bold">{{ session('subject') }}</span>
        </div>
    @endif --}}
    @if(!$noResultYet)
    <div class="text-right">
        @if (auth()->user()->role === 'homeroom-teacher')
            @if ($topStudents->first()?->updated_at)
                @if (!$noResultYet)
                <div class="text-sm text-gray-600 italic mb-4">
                    The final selection result is calculated on:
                    <strong class="text-yellow-500">{{ $topStudents->first()->updated_at->format('d M Y, H:i') }}</strong>
                </div>
                @endif
            @endif
        @endif
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 fw-bold">Result MOORA Metode</h2>
        @if (auth()->user()->role === 'homeroom-teacher')
        <a href="{{ route('homeroom-teacher.results.download') }}" id="downloadPdfBtn" class="btn btn-danger mb-3 fw-bold">Download PDF</a>
        @endif
        @if (in_array(Auth::user()->role, ['administration','headmaster', 'ksm-teacher']))
            @if ($topStudents->first()?->updated_at)
                @if (!$noResultYet)
                <div class="text-sm text-gray-600 italic mb-4">
                    The final selection result is calculated on:
                    <strong class="text-yellow-500">{{ $topStudents->first()->updated_at->format('d M Y, H:i') }}</strong>
                </div>
                @endif
            @endif
        @endif
    </div>
    <div>
        <table id="example" class="display">
            <thead class="table-light fw-bold">
                <tr>
                    <th>Rank</th>
                    <th>Student Name</th>
                    <th>C1<br>Nilai PAT Mapel KSM</th>
                    <th>C2<br>Nilai Rata-Rata PAI</th>
                    <th>C3<br>Nilai Akhlak</th>
                    <th>C4<br>Rangking Top 10</th>
                    <th>C5<br>Absensi</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $index => $result)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $result['student_name'] }}</td>
                        @foreach($criterias as $criteria)
                            <td>{{ $result['weighted_scores'][$criteria->id] ?? '-' }}</td>
                        @endforeach
                        <td class="fw-bold text-center">{{ $result['yi'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 fw-bold">Result K-Means Clustering Algorithm</h2>
        </div>
        <div class="row">
            @foreach (['High Score', 'Medium Score', 'Low Score'] as $label)
                <div class="col-md-4">
                    <table class="table table-bordered">
                        <thead class="table-light text-center">
                            <tr>
                                <th colspan="2">
                                    Cluster: <strong>{{ $label }}</strong>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($clustered[$label] ?? [] as $item)
                                <tr>
                                    <td class="text-end" style="width: 20px">{{ $no++ }}.</td>
                                    <td>{{ $item['student_name'] }}</td>
                                </tr>
                            @endforeach
                            @if(empty($clustered[$label]))
                                <tr>
                                    <td colspan="2" class="text-center text-muted">Tidak ada data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@endsection
