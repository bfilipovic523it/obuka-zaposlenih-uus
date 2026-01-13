<?php

namespace App\Http\Controllers;

use App\Http\Requests\SektorStoreRequest;
use App\Http\Requests\SektorUpdateRequest;
use App\Models\Sektor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SektorController extends Controller
{
    public function index(Request $request): Response
    {
        $sektors = Sektor::all();

        return view('sektor.index', [
            'sektors' => $sektors,
        ]);
    }

    public function create(Request $request): Response
    {
        return view('sektor.create');
    }

    public function store(SektorStoreRequest $request): Response
    {
        $sektor = Sektor::create($request->validated());

        $request->session()->flash('sektor.id', $sektor->id);

        return redirect()->route('sektors.index');
    }

    public function show(Request $request, Sektor $sektor): Response
    {
        return view('sektor.show', [
            'sektor' => $sektor,
        ]);
    }

    public function edit(Request $request, Sektor $sektor): Response
    {
        return view('sektor.edit', [
            'sektor' => $sektor,
        ]);
    }

    public function update(SektorUpdateRequest $request, Sektor $sektor): Response
    {
        $sektor->update($request->validated());

        $request->session()->flash('sektor.id', $sektor->id);

        return redirect()->route('sektors.index');
    }

    public function destroy(Request $request, Sektor $sektor): Response
    {
        $sektor->delete();

        return redirect()->route('sektors.index');
    }
}
