<?php

use App\Models\User;
use App\Models\Cabai;
use App\Models\Gudang;
use App\Models\Komoditas;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CabaiController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\PetaniController;
use App\Http\Middleware\isPengelolaGudang;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KomoditasController;

Route::get('/', function () {
    $cabais =  Cabai::withSum('komoditas', 'quantity')->get();
    return view('welcome', ['cabais' => $cabais]);
});

Route::get('/dashboard', function () {
    $countKomoditas = Komoditas::where('status', 'pengajuan')->count();
    $countProduk = Cabai::count();
    $countPengguna = User::count();
    $countGudang = Gudang::count();
    if (auth()->user()->role == 'pengelola gudang') {
        return view('dashboard.index', [
            'countKomoditas' => $countKomoditas,
            'countProduk' => $countProduk,
            'countPengguna' => $countPengguna,
            'countGudang' => $countGudang
        ]);
    } else {
        return redirect('/komoditas');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', isPengelolaGudang::class)->group(function () {
    Route::resource('cabai', CabaiController::class)->except(['show']);
    Route::resource('petani', PetaniController::class)->except(['show']);

    Route::resource('gudang', GudangController::class)->only(['index', 'create', 'store', 'show']);
    Route::post('/gudang/{komoditas}/sell', [GudangController::class, 'sell'])->name('sell');
});

Route::middleware('auth')->group(function () {
    Route::resource('profil', ProfileController::class)->only(['index',  'store']);
   Route::resource('komoditas', KomoditasController::class)
        ->except(['show', 'edit', 'update']);

    Route::post('komoditas/{komoditas}/accept', [KomoditasController::class, 'accept'])
        ->name('komoditas.accept');

    Route::get('komoditas/{komoditas}/refuse', [KomoditasController::class, 'refuse'])
        ->name('komoditas.refuse');

});

require __DIR__ . '/auth.php';
