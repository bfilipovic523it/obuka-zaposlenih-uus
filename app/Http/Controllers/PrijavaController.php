<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrijavaStoreRequest;
use App\Http\Requests\PrijavaUpdateRequest;
use App\Models\Prijava;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PrijavaController extends Controller
{
    public function index(Request $request): Response
    {
        $prijavas = Prijava::all();

        return view('prijava.index', [
            'prijavas' => $prijavas,
        ]);
    }

    public function create(Request $request): Response
    {
        return view('prijava.create');
    }

    public function store(PrijavaStoreRequest $request): Response
    {
        $prijava = Prijava::create($request->validated());

        $request->session()->flash('prijava.id', $prijava->id);

        return redirect()->route('prijavas.index');
    }

    public function show(Request $request, Prijava $prijava): Response
    {
        return view('prijava.show', [
            'prijava' => $prijava,
        ]);
    }

    public function edit(Request $request, Prijava $prijava): Response
    {
        return view('prijava.edit', [
            'prijava' => $prijava,
        ]);
    }

    public function update(PrijavaUpdateRequest $request, Prijava $prijava): Response
    {
        $prijava->update($request->validated());

        $request->session()->flash('prijava.id', $prijava->id);

        return redirect()->route('prijavas.index');
    }

    public function destroy(Request $request, Prijava $prijava): Response
    {
        $prijava->delete();

        return redirect()->route('prijavas.index');
    }
}
