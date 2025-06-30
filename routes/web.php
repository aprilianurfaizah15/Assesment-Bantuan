<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Livewire\PenerimaPage;
use App\Livewire\PekerjaanPage;
use App\Livewire\KeluargaPage;
use App\Livewire\KendaraanPage;
use App\Livewire\StatusRumahPage;
use App\Livewire\SkorPage;

use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;

Route::get('/', Login::class);
Route::get('/dashboard', Dashboard::class)->name('dashboard');

// Rute logout (POST)
	Route::get('/logout', function(Request $request){
      		Auth::logout();
      		$request->session()->flush();
      		return redirect('/');
	})->name('logout');

Route::get('/penerima', PenerimaPage::class)->name('penerima');
Route::get('/pekerjaan', PekerjaanPage::class)->name('pekerjaan');
Route::get('/keluarga', KeluargaPage::class)->name('keluarga');
Route::get('/kendaraan', KendaraanPage::class)->name('kendaraan');
Route::get('/statusrumah', StatusRumahPage::class)->name('statusrumah');
Route::get('/penerimaan-skor', SkorPage::class)->name('penerimaan-skor');

// Route::post('/logout', function (Request $request) {
//     Auth::logout();
//     $request->session()->invalidate();
//     $request->session()->regenerateToken();
//     return redirect('/');
// })->name('logout');
