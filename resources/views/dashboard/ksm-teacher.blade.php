@extends('partials.app')

@section('title', 'Dashboard - KSM-Teacher | KSM')

@section('content')
<div class="p-8 space-y-8 bg-gradient-to-br from-white via-slate-50 to-slate-100 min-h-screen">

    {{-- Greeting --}}
    <div class="mb-6">
        <h2 class="text-3xl font-bold">Welcome, {{ Auth::user()->name }} 👋</h2>
        <p class="text-slate-600 mt-2">Below is a summary of the Madrasah Science Competition (KSM) student selection results.</p>
    </div>

    {{-- Top 3 Students --}}
    <div>
        <h3 class="text-2xl font-semibold text-slate-800 mb-5">🏆 Top 3 Students (High Score Cluster)</h3>

        @if ($message)
            <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-700 px-6 py-4 rounded shadow-sm">
                {{ $message }}
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($topStudents as $student)
                    <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow hover:shadow-lg transition duration-300 ease-in-out">
                        <h4 class="text-xl font-semibold text-indigo-800 mb-2">
                            {{ $student->student->name }}
                        </h4>
                        <p class="text-slate-700 mb-1">
                            Score MOORA (Yi):
                            <span class="font-bold text-emerald-600">
                                {{ number_format($student->yi, 4) }}
                            </span>
                        </p>
                        <p class="text-slate-600">
                            Cluster:
                            <span class="italic text-sky-600">
                                {{ $student->cluster }}
                            </span>
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
@endsection
