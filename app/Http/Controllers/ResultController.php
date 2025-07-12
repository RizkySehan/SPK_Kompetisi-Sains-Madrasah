<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Criteria;
use Illuminate\Http\Request;
use App\Models\SelectionResult;
use Barryvdh\DomPDF\Facade\Pdf;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private const CLUSTER_LABELS = ['Low Score', 'Medium Score', 'High Score'];

    public function index()
    {
        $criterias = Criteria::all();

        // Ambil semua hasil
        $results = SelectionResult::with('student')->get()->map(function ($item) {
            return [
                'student_id' => $item->student_id,
                'student_name' => $item->student->name ?? '-',
                'yi' => $item->yi,
                'cluster' => $item->cluster,
                'weighted_scores' => json_decode($item->weighted_scores, true),
            ];
        });

        $noResultYet = $results->isEmpty();
        $clustered = collect($results)->groupBy('cluster');

        // Ambil Top 3 siswa dari cluster High Score
        $topStudents = SelectionResult::with('student')
            ->where('cluster', self::CLUSTER_LABELS[2]) // High Score
            ->orderByDesc('yi')
            ->take(3)
            ->get();

        return view('homeroom-teacher.results.result', compact(
            'criterias',
            'results',
            'clustered',
            'noResultYet',
            'topStudents'
        ))->with('subject', session('subject'));
    }

    public function downloadPdf()
    {
        $criterias = Criteria::all();

        $results = SelectionResult::with('student')->get()->map(function ($item) {
            return [
                'student_name' => $item->student->name ?? '-',
                'yi' => $item->yi,
                'cluster' => $item->cluster,
                'weighted_scores' => json_decode($item->weighted_scores, true),
            ];
        });

        $pdf = Pdf::loadView('homeroom-teacher.results.pdf', compact('results', 'criterias'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('hasil_seleksi_moora_kmeans.pdf');
    }



    public function generate(Request $request)
    {
        $students = Student::with('scores')->get();
        $criterias = Criteria::all();

        // Validasi kelengkapan nilai
        $incomplete = collect();
        foreach ($students as $student) {
            foreach ($criterias as $criteria) {
                if (!$student->scores->where('criteria_id', $criteria->id)->first()) {
                    $incomplete->push($student->name);
                    break;
                }
            }
        }

        if ($incomplete->isNotEmpty()) {
            return redirect()->route('homeroom-teacher.scores.index')
                ->with('error', 'There are still students who do not have complete grades: ' . $incomplete->join(', '));
        }

        // Matriks nilai
        $matrix = [];
        foreach ($students as $student) {
            foreach ($criterias as $criteria) {
                $score = $student->scores->where('criteria_id', $criteria->id)->first();
                $value = $score->value ?? 0; // langsung ambil nilai
                $matrix[$student->id][$criteria->id] = $value;
            }
        }

        // Normalisasi
        $normalizer = [];
        foreach ($criterias as $criteria) {
            $total = 0;
            foreach ($students as $student) {
                $total += pow($matrix[$student->id][$criteria->id], 2);
            }
            $normalizer[$criteria->id] = sqrt($total);
        }

        // Hitung nilai Yi
        $results = [];
        foreach ($students as $student) {
            $benefit = $cost = 0;
            $weightedScores = [];

            foreach ($criterias as $criteria) {
                $value = $matrix[$student->id][$criteria->id];
                $normalized = $normalizer[$criteria->id] > 0 ? $value / $normalizer[$criteria->id] : 0;
                $weighted = $normalized * ($criteria->bobot / 100); // kalau bobot kamu skala 100
                $weightedScores[$criteria->id] = round($weighted, 4);

                if ($criteria->type === 'benefit') {
                    $benefit += $weighted;
                } else {
                    $cost += $weighted;
                }
            }

            $yi = round($benefit - $cost, 4);
            $results[] = [
                'student_id' => $student->id,
                'student_name' => $student->name,
                'weighted_scores' => $weightedScores,
                'yi' => $yi,
            ];
        }

        // Sorting Yi desc
        usort($results, fn($a, $b) => $b['yi'] <=> $a['yi']);

        // K-Means Clustering
        $k = 3;
        $maxIterations = 10;
        $centroids = collect($results)->random($k)->pluck('yi')->toArray();

        for ($i = 0; $i < $maxIterations; $i++) {
            $clusters = array_fill(0, $k, []);
            foreach ($results as $result) {
                $distances = array_map(fn($c) => abs($result['yi'] - $c), $centroids);
                $closest = array_keys($distances, min($distances))[0];
                $clusters[$closest][] = $result;
            }

            $newCentroids = [];
            foreach ($clusters as $cluster) {
                $avg = count($cluster) ? array_sum(array_column($cluster, 'yi')) / count($cluster) : 0;
                $newCentroids[] = $avg;
            }

            if ($centroids === $newCentroids) break;
            $centroids = $newCentroids;
        }

        // Label cluster secara eksplisit berdasarkan urutan centroid dari kecil ke besar
        $sortedCentroids = $centroids;
        asort($sortedCentroids); // urut dan tetap jaga key asli
        $centroidLabels = [];
        $i = 0;
        foreach ($sortedCentroids as $originalIndex => $value) {
            $centroidLabels[$originalIndex] = self::CLUSTER_LABELS[$i++];
        }


        // Gabungkan hasil + label
        $labeledResults = [];
        foreach ($clusters as $clusterIndex => $clusterItems) {
            foreach ($clusterItems as $item) {
                $item['cluster'] = $centroidLabels[$clusterIndex];
                $labeledResults[] = $item;
            }
        }

        // Validasi jumlah High Score maksimal 6
        $highScoreCount = collect($labeledResults)->where('cluster', self::CLUSTER_LABELS[2])->count();
        if ($highScoreCount > 6) {
            return redirect()->route('homeroom-teacher.scores.index')
                ->with('error', 'High Score clusters can have no more than 6 students. Currently: ' . $highScoreCount);
        }

        // Reset hasil lama
        SelectionResult::truncate();

        // Simpan ke DB (efisien)
        SelectionResult::insert(collect($labeledResults)->map(fn($item) => [
            'student_id' => $item['student_id'],
            'yi' => $item['yi'],
            'cluster' => $item['cluster'],
            'weighted_scores' => json_encode($item['weighted_scores']),
            'created_at' => now(),
            'updated_at' => now(),
        ])->toArray());

        // Simpan ke session
        session(['kmeans_results' => $labeledResults]);

        return redirect()->route('homeroom-teacher.results.index')
            ->with('success', 'Calculation saved successfully.');
    }
}
