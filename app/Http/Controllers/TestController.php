<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestStoreRequest;
use App\Http\Requests\TestUpdateRequest;
use App\Models\Test;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $tests = Test::with('prijava.user')->get();
        return view('admin.test.index', compact('tests'));
    }

    public function create(Request $request)
    {
        return view('admin.test.create');
    }

    public function store(TestStoreRequest $request)
    {
        $test = Test::create($request->validated());

        $request->session()->flash('test.id', $test->id);

        return redirect()->route('tests.index');
    }

    public function show(Request $request, Test $test)
    {
        $test->load([
        'obuka',
        'prijava.user'
        ]);

        return view('admin.test.show', compact('test'));
    }

    public function edit(Request $request, Test $test)
    {
        return view('admin.test.edit', [
            'test' => $test,
        ]);
    }

    public function update(TestUpdateRequest $request, Test $test)
    {
        $test->update($request->validated());

        $request->session()->flash('test.id', $test->id);

        return redirect()->route('tests.index');
    }

    public function destroy(Request $request, Test $test)
    {
        $test->delete();

        return redirect()->route('tests.index');
    }
}
