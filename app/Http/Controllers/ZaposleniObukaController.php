<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Obuka;
use App\Models\Prijava;
use Illuminate\Support\Facades\Auth;

class ZaposleniObukaController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();

        $obuke = Obuka::where('sektor_id', auth()->user()->sektor_id)
            ->whereDate('datum_pocetka', '>', Carbon::today())
            ->whereDoesntHave('prijave', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->orderBy('datum_pocetka')
            ->get();

        return view('zaposleni.obuke.index', compact('obuke'));
    }

    public function mojeObuke()
    {
        $user = Auth::user();

        $prijave = Prijava::with('obuka')
            ->where('user_id', $user->id)
            ->whereIn('status', ['aktivna', 'zavrsena'])
            ->get();

        return view('zaposleni.obuke.moje', compact('prijave'));
    }

}
