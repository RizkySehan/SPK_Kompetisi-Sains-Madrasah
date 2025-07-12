<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hasil Seleksi MOORA + K-Means</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .title-2 {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .subtitle {
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="title">Hasil Seleksi Siswa Kompetisi Sains Madrasah Menggunakan Metode MOORA dan Algoritma K-Means Clustering</div>
    <div class="title-2">Madrasah Aliyah Sullamul Istiqomah</div>
    <div style="margin-bottom: 10px;">
    <div style="display: flex; justify-content: space-between; align-items-center;">
            <div>
                <div><strong>Tahun Ajaran:</strong> ..... </div>
                <div><strong>Mata Pelajaran:</strong> ..... </div>
            </div>
            <div style="text-align: right;">
                <div><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d M Y') }}</div>
            </div>
        </div>
    </div>
    {{-- TABEL MOORA --}}
    <div class="subtitle">Tabel Perhitungan Yi (Metode MOORA):</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>C1<br>Nilai PAT Mapel KSM</th>
                <th>C2<br>Nilai Rata-Rata PAI</th>
                <th>C3<br>Nilai Akhlak</th>
                <th>C4<br>Rangking Top 10</th>
                <th>C5<br>Absensi</th>
                <th>Hasil<br>((C1+C2+C3+C4)-C5)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $index => $result)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $result['student_name'] }}</td>
                    @foreach($criterias as $criteria)
                        <td>
                            {{ isset($result['weighted_scores'][$criteria->id]) 
                                ? number_format($result['weighted_scores'][$criteria->id], 4)
                                : '-' }}
                        </td>
                    @endforeach
                    <td>{{ number_format($result['yi'], 4) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- CLUSTER TABEL DALAM 1 TABEL --}}
    <div class="subtitle">Distribusi Siswa Berdasarkan K-Means Clustering:</div>
    <table>
        <thead>
            <tr>
                <th>Cluster 1 (Nilai Tinggi)</th>
                <th>Cluster 2 (Nilai Sedang)</th>
                <th>Cluster 3 (Nilai Rendah)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grouped = collect($results)->groupBy('cluster');
                $maxCount = max(
                    $grouped['High Score']?->count() ?? 0,
                    $grouped['Medium Score']?->count() ?? 0,
                    $grouped['Low Score']?->count() ?? 0
                );
            @endphp

            @for($i = 0; $i < $maxCount; $i++)
                <tr>
                    <td>{{ $grouped['High Score'][$i]['student_name'] ?? '' }}</td>
                    <td>{{ $grouped['Medium Score'][$i]['student_name'] ?? '' }}</td>
                    <td>{{ $grouped['Low Score'][$i]['student_name'] ?? '' }}</td>
                </tr>
            @endfor
        </tbody>
    </table>
        {{-- TEMPAT TANDA TANGAN --}}
    <div style="margin-top: 50px;">
        <table style="width: 100%; margin-top: 30px; border: none;">
            <tr style="border: none;">
                <td style="width: 60%; border: none;"></td> {{-- Kosongkan sisi kiri --}}
                <td style="width: 40%; text-align: center; border: none;">
                <div>Mengesahkan,</div>
                <div>Kepala Madrasah Aliyah Sullamul Istiqomah</div>
                <br><br><br><br> {{-- Ruang tanda tangan --}}
                <div><strong>(Abdul Jalil, S.E.I.)</strong></div>
                {{-- <div>NIP/NPK: ....................................</div> --}}
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
