<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Models\Uloga;
use App\Models\Sektor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with(['uloga', 'sektor'])->get();
        return view('admin.user.index', compact('users'));
    }

    public function create(Request $request)
    {
        $sektors = Sektor::all();
        $ulogas = Uloga::all();

        return view('admin.user.create', compact('sektors', 'ulogas'));
    }

    public function store(UserStoreRequest $request)
    {
        User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'uloga_id' => $request->uloga_id,
        'sektor_id' => $request->sektor_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Korisnik je uspešno dodat.');
    }

    public function show(Request $request, User $user)
    {
        return view('admin.user.show', [
            'user' => $user,
        ]);
    }

    public function edit(Request $request, User $user)
    {
        $sektors = Sektor::all();
        $ulogas = Uloga::all();

        return view('admin.user.edit', compact('user', 'sektors', 'ulogas'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'uloga_id' => 'required|exists:ulogas,id',
            'sektor_id' => 'required|exists:sektors,id',
        ]);

        // Ako je lozinka uneta → hashuj i snimi
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            // Ako nije uneta → ukloni iz niza da se ne upisuje null
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'Korisnik je uspešno izmenjen.');
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
