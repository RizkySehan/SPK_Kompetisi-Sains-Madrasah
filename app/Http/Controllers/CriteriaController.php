<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $criterias = Criteria::all();

        return view('administration.criterias.view', compact('criterias'));
    }


    /**
     * Show the form for creating a new criteria.
     */
    public function create()
    {
        return view('administration.criterias.create');
    }

    /**
     * Store a newly created criteria in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:criterias,code',
            'name' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0|max:100',
            'type' => 'required|in:benefit,cost',
        ]);

        Criteria::create([
            'code' => $validated['code'],
            'name' => $validated['name'],
            'bobot' => $validated['bobot'],
            'type' => $validated['type'],
        ]);

        return redirect()->route('administration.criterias.index')->with('success', 'Criteria successfully added.');
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
        $criteria = Criteria::findOrFail($id);
        return view('administration.criterias.edit', compact('criteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $criteria = Criteria::findOrFail($id);

        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:criterias,code,' . $id,
            'name' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0|max:100',
            'type' => 'required|in:benefit,cost',
        ]);

        $criteria->update($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Criteria successfully updated.',
            ]);
        }

        return redirect()->route('administration.criterias.index')->with('success', 'Criteria successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $criteria = Criteria::findOrFail($id);
        $criteria->delete();

        return redirect()->route('administration.criterias.index')->with('success', 'Criteria successfully deleted.');
    }
}
