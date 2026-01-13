<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObukaStoreRequest;
use App\Http\Requests\ObukaUpdateRequest;
use App\Models\Obuka;
use App\Models\Sektor;
use App\Models\User;
use App\Models\Materijal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ObukaController extends Controller
{
    public function index(Request $request)
    {
        $obukas = Obuka::all();

        return view('admin.obuka.index', [
            'obukas' => $obukas,
        ]);
    }

    public function create(Request $request)
    {
        $sektors = Sektor::all();
        $users = User::all();
        $materijals = Materijal::all();

        return view('admin.obuka.create', compact('sektors', 'users', 'materijals'));
    }

    public function store(ObukaStoreRequest $request)
    {
        $obuka = Obuka::create([
            'naziv' => $request->naziv,
            'opis' => $request->opis,
            'sektor_id' => $request->sektor_id,
            'user_id' => $request->user_id,
            'materijal_id' => $request->materijal_id,
            'datum_pocetka' => $request->datum_pocetka,
            'datum_zavrsetka' => $request->datum_zavrsetka,
            'broj_mesta' => $request->broj_mesta,
        ]);

        session()->flash('success', 'Obuka je uspešno dodata.');

        return redirect()->route('obukas.index');
    }


    public function show(Request $request, Obuka $obuka)
    {
        return view('admin.obuka.show', [
            'obuka' => $obuka,
        ]);
    }

    public function edit(Request $request, Obuka $obuka)
    {
        $sektors = Sektor::all();
        $users = User::all();
        $materijals = Materijal::all();

        return view('admin.obuka.edit', compact('obuka', 'sektors', 'users', 'materijals'));
    }

    public function update(ObukaUpdateRequest $request, Obuka $obuka)
    {
        $obuka->update($request->validated());

        $request->session()->flash('obuka.id', $obuka->id);

        return redirect()->route('obukas.index')->with('success', 'Obuka je uspešno izmenjena.');
    }

    public function destroy(Request $request, Obuka $obuka)
    {
        $obuka->delete();

        return redirect()->route('obukas.index');
    }
}
