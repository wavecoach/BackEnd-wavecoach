<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CoachController extends Controller
{

    public function index()
    {
        $coaches = User::where('role_id', 2)->get();
        return view('pages.coach.index', compact('coaches'));
    }


    public function create()
    {
        return view('pages.coach.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        $randomPassword = Str::random(8);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($randomPassword),
            'role_id' => 2,
        ]);

        return redirect()->route('coach.index')->with('success', 'Coach berhasil ditambahkan dengan password: ');
    }


    public function show(string $id)
    {
        $coach = User::findOrFail($id);
        return view('pages.coach.show', compact('coach'));
    }


    public function edit(string $id)
    {
        $coach = User::findOrFail($id);
        return view('pages.coach.edit', compact('coach'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ]);

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('coach.index')->with('error', 'User not found');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('coach.index')->with('success', 'User updated successfully');
    }


    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('coach.index')->with('error', 'User not found');
        }

        $user->delete();

        return redirect()->route('coach.index')->with('success', 'User deleted successfully');
    }
}
