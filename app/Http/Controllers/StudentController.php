<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        $criterias = Criteria::all();

        return view('administration.students.view', compact('students', 'criterias'));
    }

    public function create()
    {
        return view('administration.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nisn' => "required|string|max:255|unique:students,nisn",
            'tgl_lahir' => 'required|date',
            'tlp' => 'required|string|max:255',
            'jk' => 'required|in:L,P',
            'address' => 'required|string',
            'class' => 'required|string|max:255',
        ]);

        Student::create([
            'name' => $validated['name'],
            'nisn' => $validated['nisn'],
            'tgl_lahir' => $validated['tgl_lahir'],
            'tlp' => $validated['tlp'],
            'jk' => $validated['jk'],
            'address' => $validated['address'],
            'class' => $validated['class'],
        ]);

        return redirect()->route('administration.students.index')->with('success', 'Student succesfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        return view('administration.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nisn' => "required|string|max:255|unique:students,nisn,{$id}",
            'tgl_lahir' => 'required|date',
            'tlp' => 'required|string|max:255',
            'jk' => 'required|in:L,P',
            'address' => 'required|string',
            'class' => 'required|string|max:255',
        ]);

        $student->update($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Student successfully updated.',
            ]);
        }

        return redirect()->route('administration.students.index')->with('success', 'Student successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);

        $student->scores()->delete();
        $student->selectionResults()->delete();
        $student->delete();


        return redirect()->route('administration.students.index')->with('success', 'Student successfully deleted.');
    }
}
