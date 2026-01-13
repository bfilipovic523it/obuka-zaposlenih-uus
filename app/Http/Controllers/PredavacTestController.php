<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;

class PredavacTestController extends Controller
{
    public function index()
    {
        $predavacId = auth()->id();

        $tests = Test::whereHas('obuka', function ($query) use ($predavacId) {
                $query->where('user_id', $predavacId);
            })
            ->with([
                'obuka',
                'prijava.user'
            ])
            ->get();

        return view('predavac.tests.index', compact('tests'));
    }

    public function show(Test $test)
    {
        // sigurnosna provera
        if ($test->obuka->user_id !== auth()->id()) {
            abort(403);
        }

        return view('predavac.tests.show', compact('test'));
    }
}
