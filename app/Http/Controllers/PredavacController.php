<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Obuka;

class PredavacController extends Controller
{
    public function obuke()
    {
        $user = Auth::user();

        $obukas = Obuka::where('user_id', $user->id)->get();

        return view('predavac.obuke.index', compact('obukas'));
    }
}
