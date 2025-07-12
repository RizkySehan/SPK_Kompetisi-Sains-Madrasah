@extends('partials.app')

@section('title', 'Dashboard Homeroom | KSM')

@section('content')
<div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h2>

            <!-- Ringkasan Sistem -->
            <div class="bg-gradient-to-br from-green-100 to-white shadow rounded-xl p-6 border border-green-200">
                <div class="flex items-start gap-4">
                    <div class="p-3 rounded-full bg-green-600 text-white shadow-md">
                        <i class="fas fa-info-circle text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-1">About System</h3>
                        <p class="text-sm text-gray-700 leading-relaxed">
                            This system is designed to simplify <span class="font-medium text-green-700">the selection process of KSM students</span> using 
                            <span class="font-semibold text-green-800">MOORA</span> and <span class="font-semibold text-green-800">K-Means Clustering</span>.
                            You Can <span class="underline underline-offset-2 decoration-green-500">assess students according to criteria</span>, and 
                            <span class="underline underline-offset-2 decoration-green-500">and view selection results</span> efficiently.
                        </p>
                    </div>
                </div>
            </div>

        <div class="container py-4">
        {{-- Kriteria dan Bobot --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Criteria and Weight</h5>
            </div>
            <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                <tr>
                    <th>Criteria</th>
                    <th>Description</th>
                    <th>Weight</th>
                    <th>Weight Type</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>C1</td>
                    <td>Nilai PAT sesuai mata pelajaran KSM</td>
                    <td>25</td>
                    <td>Benefit</td>
                </tr>
                <tr>
                    <td>C2</td>
                    <td>Nilai rata-rata Pendidikan Agama Islam (PAI)</td>
                    <td>25</td>
                    <td>Benefit</td>
                </tr>
                <tr>
                    <td>C3</td>
                    <td>Akhlak siswa</td>
                    <td>20</td>
                    <td>Benefit</td>
                </tr>
                <tr>
                    <td>C4</td>
                    <td>Peringkat top 10 secara keseluruhan di kelas</td>
                    <td>20</td>
                    <td>Benefit</td>
                </tr>
                <tr>
                    <td>C5</td>
                    <td>Absensi</td>
                    <td>10</td>
                    <td>Cost</td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>

        {{-- Tabulation C3 (Akhlak) --}}
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
            <h5 class="mb-0">Tabulation C3 – Akhlak Siswa</h5>
            </div>
            <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-light">
                <tr>
                    <th>Value</th>
                    <th>Tabulation</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <tr><td>4</td><td>Sangat Baik</td><td>Tidak pernah melanggar, sopan, rajin ibadah, suka membantu, jadi panutan.</td></tr>
                <tr><td>3</td><td>Baik</td><td>Umumnya baik, kadang ditegur ringan, tetap sopan dan bertanggung jawab.</td></tr>
                <tr><td>2</td><td>Cukup</td><td>Sering ditegur, kurang sopan, kurang aktif, kurang peduli sosial.</td></tr>
                <tr><td>1</td><td>Kurang</td><td>Sering bermasalah, ditegur berulang, mungkin pernah diberi sanksi.</td></tr>
                </tbody>
            </table>
            </div>
        </div>

        {{-- Tabulation C4 (Kedisiplinan) --}}
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">Tabulation C4 – Peringkat Top 10</h5>
            </div>
            <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-light">
                <tr>
                    <th>Value</th>
                    <th>Tabulation</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <tr><td>4</td><td>Sangat Unggul</td><td>Hampir selalu masuk 10 besar tiap semester, sering juara lomba akademik.</td></tr>
                <tr><td>3</td><td>Unggul</td><td>Masuk top 10 di sebagian besar semester, konsisten di atas rata-rata.</td></tr>
                <tr><td>2</td><td>Cukup Unggul</td><td>Hanya 1–2 kali masuk top 10, selebihnya di peringkat menengah.</td></tr>
                <tr><td>1</td><td>Tidak Unggul</td><td>Tidak pernah masuk 10 besar, prestasi akademik tidak menonjol.</td></tr>
                </tbody>
            </table>
            </div>
        </div>

        {{-- Tabulation C5 (Peringkat) --}}
        <div class="card mb-4">
            <div class="card-header bg-info text-dark">
            <h5 class="mb-0">Tabulation C5 – Absensi</h5>
            </div>
            <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-light">
                <tr>
                    <th>Jumlah Alpa</th>
                    <th>Jumlah Izin</th>
                    <th>Jumlah Sakit</th>
                    <th>Perhitungan Bobot</th>
                    <th>Nilai C5</th>
                </tr>
                </thead>
                <tbody>
                <tr><td>0</td><td>0</td><td>0</td><td>0x3+0x2+0x1</td><td>0</td></tr>
                <tr><td>1</td><td>0</td><td>0</td><td>1x3+0x2+0x1</td><td>3</td></tr>
                <tr><td>2</td><td>1</td><td>1</td><td>2x3+1x2+1x1</td><td>9</td></tr>
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
@endsection