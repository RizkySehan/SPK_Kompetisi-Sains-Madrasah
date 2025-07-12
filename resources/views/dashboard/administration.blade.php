@extends('partials.app')

@section('title', 'Dashboard - Administration | KSM')

@section('content')
<div class="p-6">

    <h2 class="text-2xl font-bold mb-6">
        Welcome, {{ Auth::user()->name }}!
    </h2>

    <!-- Ringkasan Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

        <!-- Total Users -->
        <div class="bg-white shadow rounded-xl p-5 border-t-4 border-blue-600">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xl font-medium text-gray-600">Users Count</span>
                <i class="fas fa-users text-blue-600 text-2xl"></i>
            </div>
            <div class="text-2xl font-bold text-gray-800">{{ $totalUsers ?? 0 }}</div>
        </div>

        <!-- Total Siswa -->
        <div class="bg-white shadow rounded-xl p-5 border-t-4 border-green-600">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xl font-medium text-gray-600">Registered Students</span>
                <i class="fas fa-user-graduate text-green-600 text-2xl"></i>
            </div>
            <div class="text-2xl font-bold text-gray-800">{{ $totalSiswa ?? 0 }}</div>
        </div>

        <!-- Total Kriteria -->
        <div class="bg-white shadow rounded-xl p-5 border-t-4 border-yellow-500">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xl font-medium text-gray-600">Assessment Criteria</span>
                <i class="fas fa-list text-yellow-500 text-2xl"></i>
            </div>
            <div class="text-2xl font-bold text-gray-800">{{ $totalKriteria ?? 0 }}</div>
        </div>
    </div>

</div>
@endsection
