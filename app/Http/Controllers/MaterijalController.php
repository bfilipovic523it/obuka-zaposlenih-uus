<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterijalStoreRequest;
use App\Http\Requests\MaterijalUpdateRequest;
use App\Models\Materijal;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MaterijalController extends Controller
{
    public function index(Request $request)
    {
        $materijals = Materijal::all();

        return view('predavac.materijal.index', [
            'materijals' => $materijals,
        ]);
    }

    public function create(Request $request)
    {
        $users = User::all();

        return view('predavac.materijal.create', compact('users'));
    }

    public function store(MaterijalStoreRequest $request)
    {
        $data = $request->validate([
        'naziv' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id',
        ]);

        Materijal::create($data);

        return redirect()->route('predavac.obuke')
            ->with('success', 'Materijal je uspešno dodat.');
    }

    public function show(Request $request, Materijal $materijal)
    {
        return view('predavac.materijal.show', [
            'materijal' => $materijal,
        ]);
    }

    public function edit(Request $request, Materijal $materijal)
    {
        $users = User::all();

        return view('predavac.materijal.edit', compact('materijal', 'users'));
    }

    public function update(MaterijalUpdateRequest $request, Materijal $materijal)
    {
        $data = $request->validate([
        'naziv' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id',
        ]);

        $materijal->update($data);

        return redirect()->route('predavac.obuke')
            ->with('success', 'Materijal je uspešno izmenjen.');
    }

    public function destroy(Request $request, Materijal $materijal)
    {
        $materijal->delete();

        return redirect()->route('materijals.index');
    }
}
