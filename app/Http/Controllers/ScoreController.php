<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Student;
use App\Models\Criteria;
use Illuminate\Http\Request;
use App\Models\SelectionResult;

class ScoreController extends Controller
{
    public function index()
    {
        $students = Student::with(['scores.criteria'])->get();
        $criterias = Criteria::all();

        return view('homeroom-teacher.scores.view', compact('students', 'criterias'));
    }

    public function setSubject(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|in:Matematika,Geografi,Ekonomi'
        ]);

        session(['subject' => $request->subject]);

        return back()->with('success', 'Mapel untuk penilaian telah diset: ' . $request->subject);
    }

    public function create(Student $student)
    {
        $criterias = Criteria::all();

        return view('homeroom-teacher.scores.create', compact('student', 'criterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'scores' => 'required|array',
            'attendance.alpha' => 'nullable|numeric|min:0',
            'attendance.izin' => 'nullable|numeric|min:0',
            'attendance.sakit' => 'nullable|numeric|min:0',
        ]);

        $criterias = Criteria::all()->keyBy('id');

        foreach ($request->scores as $criteria_id => $value) {
            $criteria = $criterias[$criteria_id];

            if (in_array($criteria->code, ['C3', 'C4']) && !in_array($value, [1, 2, 3, 4])) {
                return back()->withErrors([
                    "scores.$criteria_id" => "The score for this criterion should be between 1 and 4."
                ])->withInput();
            }

            Score::updateOrCreate(
                ['student_id' => $request->student_id, 'criteria_id' => $criteria_id],
                ['value' => $value]
            );
        }

        $c5 = Criteria::where('code', 'C5')->first();
        if ($c5) {
            $alpha = (int) ($request->attendance['alpha'] ?? 0);
            $izin  = (int) ($request->attendance['izin'] ?? 0);
            $sakit = (int) ($request->attendance['sakit'] ?? 0);
            $c5Value = min(($alpha * 3) + ($izin * 2) + ($sakit * 1), 30);

            Score::updateOrCreate(
                ['student_id' => $request->student_id, 'criteria_id' => $c5->id],
                ['value' => $c5Value]
            );
        }

        session()->forget('kmeans_results');

        return back()->with('success', 'Score successfully added.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'scores' => 'required|array',
            'scores.*' => 'required|numeric|min:0|max:100',
            'attendance.alpha' => 'nullable|numeric|min:0',
            'attendance.izin' => 'nullable|numeric|min:0',
            'attendance.sakit' => 'nullable|numeric|min:0',
        ]);

        $scores = $request->input('scores');

        $c5 = Criteria::where('code', 'C5')->first();
        if ($c5 && $request->has('attendance')) {
            $alpha = (int) $request->input('attendance.alpha', 0);
            $izin  = (int) $request->input('attendance.izin', 0);
            $sakit = (int) $request->input('attendance.sakit', 0);

            $c5Value = min(($alpha * 3) + ($izin * 2) + ($sakit * 1), 30);

            Score::updateOrCreate(
                ['student_id' => $request->student_id, 'criteria_id' => $c5->id],
                ['value' => $c5Value]
            );

            unset($scores[$c5->id]);
        }

        foreach ($scores as $criteria_id => $value) {
            Score::updateOrCreate(
                ['student_id' => $request->student_id, 'criteria_id' => $criteria_id],
                ['value' => $value]
            );
        }

        session()->forget('kmeans_results');

        return redirect()->back()->with('success', 'Score successfully updated.');
    }

    public function destroy(string $id)
    {
        $score = Score::findOrFail($id);
        $studentId = $score->student_id;

        $score->delete();

        SelectionResult::where('student_id', $studentId)->delete();
        session()->forget('kmeans_results');

        return redirect()->back()->with('success', 'Score successfully deleted.');
    }

    public function deleteByStudent(Student $student)
    {
        $student->scores()->delete();

        SelectionResult::where('student_id', $student->id)->delete();
        session()->forget('kmeans_results');

        return redirect()->back()->with('success', 'All scores for the student deleted successfully.');
    }

    public function destroyAll()
    {
        Score::truncate();
        SelectionResult::truncate();
        session()->forget('kmeans_results');

        return redirect()->route('homeroom-teacher.scores.index')
            ->with('success', 'All score data successfully deleted.');
    }
}
