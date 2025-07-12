<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('criterias')->insert([
            [
                'code' => 'C1',
                'name' => 'Nilai PAT sesuai mata pelajaran KSM',
                'bobot' => 25,
                'type' => 'benefit',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'C2',
                'name' => 'Nilai rata-rata Pendidikan Agama Islam (PAI)',
                'bobot' => 25,
                'type' => 'benefit',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'C3',
                'name' => 'Akhlak siswa',
                'bobot' => 20,
                'type' => 'benefit',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'C4',
                'name' => 'Peringkat top 10 secara keseluruhan di kelas',
                'bobot' => 20,
                'type' => 'benefit',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'C5',
                'name' => 'Absensi',
                'bobot' => 10,
                'type' => 'cost',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
