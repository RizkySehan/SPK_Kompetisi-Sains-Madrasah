<?php

namespace Database\Seeders;

use App\Models\Score;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $absensiData = [
            // [nilai C1, C2, C3, C4, alpha, izin, sakit]
            [81, 87.25, 3, 1, 1, 0, 3],
            [83, 87, 3, 1, 0, 1, 0],
            [82, 87, 3, 1, 1, 1, 6],
            [82, 89, 3, 1, 0, 0, 5],
            [83, 85.75, 2, 1, 0, 1, 2],
            [82, 86, 3, 1, 0, 4, 1],
            [86, 90.5, 3, 4, 0, 0, 2],
            [83, 88.25, 4, 1, 0, 7, 4],
            [85, 87.5, 3, 2, 0, 1, 0],
            [82, 88.25, 2, 3, 0, 0, 0],
            [82, 87.75, 3, 1, 4, 0, 5],
            [81, 86.5, 3, 1, 0, 0, 9],
            [84, 92.25, 4, 4, 0, 0, 1],
            [82, 85, 2, 1, 2, 0, 1],
            [82, 89.75, 3, 3, 0, 1, 0],
            [83, 87.75, 3, 1, 0, 1, 11],
            [82, 88, 3, 1, 2, 1, 8],
            [83, 92, 4, 4, 0, 0, 0],
            [82, 86.5, 3, 1, 0, 2, 0],
            [83, 86, 3, 1, 1, 2, 7],
            [82, 86.5, 3, 2, 3, 1, 1],
            [84, 89, 3, 2, 0, 0, 3],
            [82, 88.25, 4, 1, 3, 0, 8],
            [83, 88.25, 4, 2, 0, 0, 8],
            [83, 87.5, 3, 1, 2, 2, 6],
            [86, 91.75, 4, 4, 0, 0, 0],
            [82, 89.5, 3, 2, 5, 1, 4],
            [84, 89.5, 3, 3, 4, 1, 11],
            [84, 89, 3, 3, 0, 0, 0],
            [83, 88.5, 3, 1, 0, 0, 5],
            [81, 86.25, 3, 1, 1, 0, 5],
            [83, 86.5, 2, 1, 1, 2, 15],
            [83, 88.25, 3, 3, 0, 0, 7],
            [83, 87.75, 3, 1, 0, 0, 4],
            [83, 88.5, 3, 2, 0, 1, 2],
            [82, 88.25, 3, 1, 0, 0, 1],
            [83, 88.25, 4, 4, 0, 0, 0],
        ];

        foreach ($absensiData as $index => $data) {
            $studentId = $index + 1;

            $alpha = $data[4];
            $izin  = $data[5];
            $sakit = $data[6];

            $nilaiC5 = min(($alpha * 3) + ($izin * 2) + ($sakit * 1), 30);

            $scores = [
                ['criteria_id' => 1, 'value' => $data[0]],
                ['criteria_id' => 2, 'value' => $data[1]],
                ['criteria_id' => 3, 'value' => $data[2]],
                ['criteria_id' => 4, 'value' => $data[3]],
                ['criteria_id' => 5, 'value' => $nilaiC5],
            ];

            foreach ($scores as $score) {
                Score::create([
                    'student_id' => $studentId,
                    'criteria_id' => $score['criteria_id'],
                    'value' => $score['value'],
                ]);
            }
        }
    }
}
