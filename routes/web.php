<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Adminteam\UserController;
use App\Http\Controllers\Adminteam\MarketingController;
use App\Http\Controllers\Adminteam\KabupatenController;
use App\Http\Controllers\Adminteam\InstansiController;
use App\Http\Controllers\Adminteam\Shiftmasuka;
use App\Http\Controllers\Adminteam\Shiftselesaia;
use App\Http\Controllers\Absensi\HomeController;
use App\Http\Controllers\Absensi\AuthController;
use App\Http\Controllers\Absensi\ShiftmasukController;
use App\Http\Controllers\Absensi\ShiftselesaiController;

//halaman login admin
Route::get('adminteam/login', 'App\Http\Controllers\Adminteam\Login_Controller@index')->name('adminteam.login'); 
Route::get('adminteam/lupa-password', 'App\Http\Controllers\Adminteam\Login_Controller@lupa_password')->name('adminteam.lupa_password');
Route::post('adminteam/cek-login', 'App\Http\Controllers\Adminteam\Login_Controller@cek_login')->name('adminteam.cek_login');
Route::get('adminteam/logout', 'App\Http\Controllers\Adminteam\Login_Controller@logout')->name('adminteam.logout');
// user
Route::get('adminteam/user', 'App\Http\Controllers\adminteam\UserController@index')->name('user');
Route::get('adminteam/user/tambah', 'App\Http\Controllers\adminteam\UserController@tambah');
Route::post('adminteam/user/proses-tambah', 'App\Http\Controllers\adminteam\UserController@proses_tambah');
Route::get('adminteam/user/edit/{id}', 'App\Http\Controllers\adminteam\UserController@edit');
Route::post('adminteam/user/proses-edit', 'App\Http\Controllers\adminteam\UserController@proses_edit');
Route::post('adminteam/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
Route::get('adminteam/user/ganti-password', [UserController::class, 'ganti_password'])->name('user.ganti_password');
Route::post('adminteam/user/ganti-password/proses', [UserController::class, 'proses_ganti_password'])->name('user.proses_ganti_password');

// Marketing
Route::get('adminteam/marketing', 'App\Http\Controllers\adminteam\MarketingController@index')->name('marketing');
Route::get('adminteam/marketing/tambah', 'App\Http\Controllers\adminteam\MarketingController@tambah');
Route::post('adminteam/marketing/proses-tambah', 'App\Http\Controllers\adminteam\MarketingController@proses_tambah');
Route::get('adminteam/marketing/edit/{id}', 'App\Http\Controllers\adminteam\MarketingController@edit');
Route::post('adminteam/marketing/proses-edit/{id}', [MarketingController::class, 'proses_edit'])->name('marketing.proses_edit');
Route::post('adminteam/marketing/delete/{id}', [MarketingController::class, 'delete'])->name('marketing.delete');

//kabupaten
Route::get('adminteam/kabupaten', [KabupatenController::class, 'index'])->name('kabupaten.index');
Route::get('adminteam/kabupaten/tambah', 'App\Http\Controllers\adminteam\KabupatenController@tambah');
Route::post('adminteam/kabupaten/proses-tambah', 'App\Http\Controllers\adminteam\KabupatenController@proses_tambah');
Route::get('adminteam/kabupaten/edit/{id}', 'App\Http\Controllers\adminteam\KabupatenController@edit');
Route::post('adminteam/kabupaten/proses-edit', 'App\Http\Controllers\adminteam\KabupatenController@proses_edit');
Route::post('adminteam/kabupaten/delete/{id}', [KabupatenController::class, 'delete'])->name('kabupaten.delete');

//kabupaten
Route::get('adminteam/instansi', [InstansiController::class, 'index'])->name('instansi.index');
Route::get('adminteam/instansi/tambah', 'App\Http\Controllers\adminteam\InstansiController@tambah');
Route::post('adminteam/instansi/proses-tambah', 'App\Http\Controllers\adminteam\InstansiController@proses_tambah');
Route::get('adminteam/instansi/edit/{id}', 'App\Http\Controllers\adminteam\InstansiController@edit');
Route::post('adminteam/instansi/proses-edit', 'App\Http\Controllers\adminteam\InstansiController@proses_edit');
Route::post('adminteam/instansi/delete/{id}', [InstansiController::class, 'delete'])->name('instansi.delete');

// Masuk Shift
Route::get('adminteam/masuka', 'App\Http\Controllers\adminteam\Shiftmasuka@index')->name('masuka.index');
Route::get('adminteam/masuka/tambah', 'App\Http\Controllers\adminteam\Shiftmasuka@tambah')->name('masuka.tambah');
Route::post('adminteam/masuka/proses-tambah', 'App\Http\Controllers\adminteam\Shiftmasuka@proses_tambah')->name('masuk.proses_tambah');
Route::post('adminteam/masuka/delete/{id}', [Shiftmasuka::class, 'delete'])->name('masuk.delete');
Route::get('/masuka/cetak/{id}', [Shiftmasuka::class, 'cetak'])->name('masuk.cetak');
Route::get('adminteam/masuka/ambil-catatan', [Shiftmasuka::class, 'ambil_catatan']);

// Selesai
Route::get('adminteam/selesaia', 'App\Http\Controllers\adminteam\Shiftselesaia@index')->name('selesaia.index');
Route::get('adminteam/selesaia/tambah', 'App\Http\Controllers\adminteam\Shiftselesaia@tambah')->name('selesaia.tambah');
Route::post('adminteam/selesaia/proses-tambah', 'App\Http\Controllers\adminteam\Shiftselesaia@proses_tambah')->name('selesaia.proses_tambah');
Route::post('/selesaia/delete/{id}', [Shiftselesaia::class, 'delete'])->name('selesai.delete');
Route::get('/selesaia/cetak/{id}', [Shiftselesaia::class, 'cetak'])->name('selesai.cetak');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/ganti-password', [AuthController::class, 'gantiPassword'])->name('userpublic.ganti_password');
    Route::put('/update-password', [AuthController::class, 'updatePassword'])->name('userpublic.update_password');
});

// Masuk Shift
Route::get('absensi/masuk', 'App\Http\Controllers\Absensi\ShiftmasukController@index')->name('masuk.index');
Route::get('absensi/masuk/tambah', 'App\Http\Controllers\Absensi\ShiftmasukController@tambah')->name('masuk.tambah');
Route::post('absensi/masuk/proses-tambah', 'App\Http\Controllers\Absensi\ShiftmasukController@proses_tambah')->name('masuk.proses_tambah');
Route::post('absensi/masuk/delete/{id}', [ShiftmasukController::class, 'delete'])->name('masuk.delete');
Route::get('/masuk/cetak/{id}', [ShiftmasukController::class, 'cetak'])->name('masuk.cetak');
Route::get('absensi/masuk/ambil-catatan', [ShiftmasukController::class, 'ambil_catatan']);

// Selesai
Route::get('absensi/selesai', 'App\Http\Controllers\Absensi\ShiftselesaiController@index')->name('masuk.index');
Route::get('absensi/selesai/tambah', 'App\Http\Controllers\Absensi\ShiftselesaiController@tambah')->name('masuk.tambah');
Route::post('absensi/selesai/proses-tambah', 'App\Http\Controllers\Absensi\ShiftselesaiController@proses_tambah')->name('masuk.proses_tambah');
Route::post('absensi/selesai/delete/{id}', [ShiftselesaiController::class, 'delete'])->name('selesai.delete');
Route::get('/selesai/cetak/{id}', [ShiftselesaiController::class, 'cetak'])->name('selesai.cetak');