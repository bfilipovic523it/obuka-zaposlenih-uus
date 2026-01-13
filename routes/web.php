<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ObukaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PrijavaController;
use App\Http\Controllers\PredavacController;
use App\Http\Controllers\MaterijalController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\ZaposleniObukaController;
use App\Http\Controllers\ZaposleniPrijavaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('ulogas', App\Http\Controllers\UlogaController::class);

    Route::resource('sektors', App\Http\Controllers\SektorController::class);

    Route::resource('sertifikats', App\Http\Controllers\SertifikatController::class);
});

Route::middleware(['auth', 'is_admin'])->group(function () {

    Route::resource('obukas', ObukaController::class);
    Route::resource('users', UserController::class);
    Route::resource('tests', TestController::class);
    Route::resource('prijavas', PrijavaController::class);

});

Route::middleware(['auth', 'is_predavac'])->group(function () {
    Route::get('/predavac/obuke', [PredavacController::class, 'obuke'])
        ->name('predavac.obuke');

    Route::resource('materijals', App\Http\Controllers\MaterijalController::class);

    Route::get('/predavac/tests', [\App\Http\Controllers\PredavacTestController::class, 'index'])
        ->name('predavac.tests.index');

    Route::get('/predavac/tests/{test}', [\App\Http\Controllers\PredavacTestController::class, 'show'])
        ->name('predavac.tests.show');
});

Route::middleware(['auth', 'is_zaposleni'])->group(function () {

    Route::get('/zaposleni/obuke', [ZaposleniObukaController::class, 'index'])
        ->name('zaposleni.obuke.index');

    Route::get('zaposleni/prijave', [ZaposleniPrijavaController::class, 'prijave'])
        ->name('zaposleni.prijave');

    Route::post('/zaposleni/prijave', [ZaposleniPrijavaController::class, 'store'])
        ->name('zaposleni.prijave.store');

    Route::get('/zaposleni/moje-obuke', 
        [ZaposleniObukaController::class, 'mojeObuke']
    )->name('zaposleni.moje_obuke');

    Route::get('/zaposleni/sertifikat/{prijava}',
        [SertifikatController::class, 'generate']
    )->name('zaposleni.sertifikat');

});

require __DIR__.'/auth.php';



