<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserManagement;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua user dari database
        $users = UserManagement::all();

        return view('administration.user_management.view', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administration.user_management.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:administration,homeroom-teacher,headmaster,ksm-teacher',
        ]);

        UserManagement::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'active' => true,
        ]);

        return redirect()->route('administration.users.index')->with('success', 'User succesfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = UserManagement::findOrFail($id);
        return view('administration.user_management.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = UserManagement::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$id}",
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:administration,homeroom-teacher,headmaster,ksm-teacher',
        ]);

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->update($validated);


        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'User successfully updated.',
            ]);
        }

        return redirect()->route('administration.users.index')->with('success', 'User successfully updated.');
    }

    public function destroy(string $id)
    {
        $user = UserManagement::findOrFail($id);
        $user->delete();

        return redirect()->route('administration.users.index')->with('success', 'User successfully deleted.');
    }
}
