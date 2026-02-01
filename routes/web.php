<?php

use App\Models\User;
use App\Models\Cabai;
use App\Models\Gudang;
use App\Models\Komoditas;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CabaiController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KomoditasController;
use App\Http\Middleware\IsPengelolaGudang;

/*
|--------------------------------------------------------------------------
| HALAMAN DEPAN
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $cabais = Cabai::withSum('komoditas', 'quantity')->get();
    return view('welcome', compact('cabais'));
});

/*
|--------------------------------------------------------------------------
| DASHBOARD (KHUSUS PENGELOLA GUDANG)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {

    if (auth()->user()->role !== 'pengelola_gudang') {
        return redirect('/komoditas');
    }

    return view('dashboard.index', [
        'countKomoditas' => Komoditas::where('status', 'pengajuan')->count(),
        'countProduk'    => Cabai::count(),
        'countPengguna'  => User::count(),
        'countGudang'    => Gudang::count(),
    ]);

})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| ROUTE KHUSUS PENGELOLA GUDANG
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', IsPengelolaGudang::class])->group(function () {

    // ===== PETANI =====
    Route::get('petani', [PetaniController::class, 'index'])->name('petani.index');
    Route::get('petani/create', [PetaniController::class, 'create'])->name('petani.create');
    Route::post('petani', [PetaniController::class, 'store'])->name('petani.store');

    Route::get('petani/{id}/edit-password', [PetaniController::class, 'editPassword'])
        ->name('petani.editPassword');

    Route::put('petani/{id}/update-password', [PetaniController::class, 'updatePassword'])
        ->name('petani.updatePassword');

    Route::delete('petani/{id}', [PetaniController::class, 'destroy'])
        ->name('petani.destroy');

    // ===== CABAI =====
    Route::resource('cabai', CabaiController::class)->except(['show']);

    // ===== GUDANG =====
    Route::resource('gudang', GudangController::class)
        ->only(['index', 'create', 'store', 'show']);

    Route::post('/gudang/{komoditas}/sell', [GudangController::class, 'sell'])
        ->name('gudang.sell');
});

/*
|--------------------------------------------------------------------------
| ROUTE USER LOGIN BIASA
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::resource('profil', ProfileController::class)
        ->only(['index', 'store']);

    Route::resource('komoditas', KomoditasController::class)
        ->except(['show', 'edit', 'update']);

    Route::post('komoditas/{komoditas}/accept', [KomoditasController::class, 'accept'])
        ->name('komoditas.accept');

    Route::get('komoditas/{komoditas}/refuse', [KomoditasController::class, 'refuse'])
        ->name('komoditas.refuse');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (BREEZE / JETSTREAM)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
