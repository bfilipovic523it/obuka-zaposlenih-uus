<?php

namespace App\Http\Controllers;

use App\Http\Requests\SertifikatStoreRequest;
use App\Http\Requests\SertifikatUpdateRequest;
use App\Models\Sertifikat;
use App\Models\Prijava;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;

class SertifikatController extends Controller
{
    public function generate(Prijava $prijava)
    {
        abort_if($prijava->user_id !== auth()->id(), 403);
        abort_if($prijava->status !== 'zavrsena', 403);

        $sertifikat = $prijava->sertifikat;

        if (!$sertifikat) {
            $sertifikat = Sertifikat::create([
                'prijava_id' => $prijava->id,
                'kod' => strtoupper(Str::random(12)),
                'datum_izdavanja' => Carbon::now(),
            ]);
        }

        return view('zaposleni.obuke.moje', compact('sertifikat'));
    }

    public function index(Request $request)
    {
        $sertifikats = Sertifikat::all();

        return view('zaposleni.sertifikat.index', [
            'sertifikats' => $sertifikats,
        ]);
    }

    public function create(Request $request)
    {
        return view('zaposleni.sertifikat.create');
    }

    public function store(SertifikatStoreRequest $request)
    {
        $sertifikat = Sertifikat::create($request->validated());

        $request->session()->flash('.sertifikat.id', $sertifikat->id);

        return redirect()->route('sertifikats.index');
    }

    public function show(Request $request, Sertifikat $sertifikat)
    {
        return view('zaposleni.sertifikat.show', [
            'sertifikat' => $sertifikat,
        ]);
    }

    public function edit(Request $request, Sertifikat $sertifikat)
    {
        return view('zaposleni.sertifikat.edit', [
            'sertifikat' => $sertifikat,
        ]);
    }

    public function update(SertifikatUpdateRequest $request, Sertifikat $sertifikat)
    {
        $sertifikat->update($request->validated());

        $request->session()->flash('sertifikat.id', $sertifikat->id);

        return redirect()->route('sertifikats.index');
    }

    public function destroy(Request $request, Sertifikat $sertifikat)
    {
        $sertifikat->delete();

        return redirect()->route('sertifikats.index');
    }
}
