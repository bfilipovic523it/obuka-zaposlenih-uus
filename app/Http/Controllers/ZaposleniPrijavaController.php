<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Prijava;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZaposleniPrijavaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'obuka_id' => 'required|exists:obukas,id',
        ]);

        Prijava::create([
            'user_id'  => Auth::id(),
            'obuka_id' => $request->obuka_id,
            'status'   => 'aktivna',
            'datum'    => now(),
        ]);

        return redirect()
            ->route('zaposleni.obuke.index')
            ->with('success', 'Uspešno ste se prijavili na obuku.');
    }
}
