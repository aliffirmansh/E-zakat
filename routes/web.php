<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;


// 
Route::get('/', function () {
    return view('index');
});

Route::get('/zakat_penghasilan', function () {
    return view('penghasilan');
});

Route::get('/zakat_maal', function () {
    return view('maal');
});

Route::get('/perdagangan', function () {
    return view('perdagangan');
});

Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/emas', function () {
    return view('emas');
});

Route::get('/tabungan', function () {
    return view('tabungan');
});

Route::get('/perusahaan', function () {
    return view('perusahaan');
});


Route::get('/register', function () {
    return view('register');
});


Route::get('/daftar', [App\Http\Controllers\Registercontroller::class, 'create']);
Route::post('/daftar', [App\Http\Controllers\Registercontroller::class, 'store']);

Route::resource('zakat', \App\Http\Controllers\ZakatController::class);
// masjid update
Route::resource('Masjid', \App\Http\Controllers\MesjidController::class);

Route::resource('penyaluran', \App\Http\Controllers\PenyaluranController::class);

Route::resource('dashboard', \App\Http\Controllers\DashboardControler::class);


Route::resource('muzzaki', \App\Http\Controllers\muzzakiController::class);

Route::resource('donasi', \App\Http\Controllers\DonasiController::class);
Route::resource('mustahik', \App\Http\Controllers\mustahikController::class);
Route::resource('pembayaran', \App\Http\Controllers\ZakatFitrahController::class)->middleware('auth');
Route::resource('maal', \App\Http\Controllers\maalController::class)->middleware('auth');

Route::get('/masuk', [App\Http\Controllers\LoginController::class, 'index']);


// Route::group(['middleware' => ['auth', 'superadmin']], function () {
//     Route::get('/superadmin/dashboard', [SuperadminController::class, 'index'])->name('superadmin.dashboard');
// });


Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::post('/masuk', [App\Http\Controllers\LoginController::class, 'login']);


Route::get('/offline', function () {
    return view('modules/laravelpwa/offline');
});