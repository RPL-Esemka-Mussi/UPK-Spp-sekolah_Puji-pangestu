<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'guest'], function(){
Route::get('/Login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/auth', [\App\Http\Controllers\LoginController::class, 'auth']);
});

Route::group(['middleware' => 'auth'], function(){
Route::get('/', [\App\Http\Controllers\LoginController::class, 'index']);
Route::post('/logout', [\App\Http\Controllers\LoginController::class, 'logout']);

});

Route::group(['middleware' => 'level:admin , petugas , siswa','auth'], function(){

});


Route::group(['middleware' => 'level:admin','auth'], function(){
//Route User
Route::get('/user', [\App\Http\Controllers\userController::class, 'index']);
Route::get('/user/tambah', [\App\Http\Controllers\userController::class, 'tambah']);
Route::post('/user/simpan', [\App\Http\Controllers\userController::class, 'simpan']);
Route::get('/user/edit/{id}', [\App\Http\Controllers\userController::class, 'edit']);
Route::post('/user/update', [\App\Http\Controllers\userController::class, 'update']);
Route::get('/user/hapus/{id}', [\App\Http\Controllers\userController::class, 'hapus']);

//Route kelas
Route::get('/kelas', [\App\Http\Controllers\kelasController::class, 'index']);
Route::get('/kelas/tambah', [\App\Http\Controllers\kelasController::class, 'tambah']);
Route::post('/kelas/simpan', [\App\Http\Controllers\kelasController::class, 'simpan']);
Route::get('/kelas/edit/{id}', [\App\Http\Controllers\kelasController::class, 'edit']);
Route::post('/kelas/update', [\App\Http\Controllers\kelasController::class, 'update']);
Route::get('/kelas/hapus/{id}', [\App\Http\Controllers\kelasController::class, 'hapus']);

//Route spp
Route::get('/spp', [\App\Http\Controllers\sppController::class, 'index']);
Route::get('/spp/tambah', [\App\Http\Controllers\sppController::class, 'tambah']);
Route::post('/spp/simpan', [\App\Http\Controllers\sppController::class, 'simpan']);
Route::get('/spp/edit/{id}', [\App\Http\Controllers\sppController::class, 'edit']);
Route::post('/spp/update', [\App\Http\Controllers\sppController::class, 'update']);
Route::get('/spp/hapus/{id}', [\App\Http\Controllers\sppController::class, 'hapus']);

//Route siswa
Route::get('/siswa', [\App\Http\Controllers\siswaController::class, 'index']);
Route::get('/siswa/tambah', [\App\Http\Controllers\siswaController::class, 'tambah']);
Route::post('/siswa/simpan', [\App\Http\Controllers\siswaController::class, 'simpan']);
Route::get('/siswa/edit/{id}', [\App\Http\Controllers\siswaController::class, 'edit']);
Route::post('/siswa/update', [\App\Http\Controllers\siswaController::class, 'update']);
Route::get('/siswa/hapus/{id}', [\App\Http\Controllers\siswaController::class, 'hapus']);

//Route pembayaran
Route::get('/pembayaran', [\App\Http\Controllers\pembayaranController::class, 'index']);
Route::get('/pembayaran/transaksi/{id}', [\App\Http\Controllers\pembayaranController::class, 'transaksi']);
Route::get('/pembayaran/tambah', [\App\Http\Controllers\pembayaranController::class, 'tambah']);
Route::post('/pembayaran/simpan', [\App\Http\Controllers\pembayaranController::class, 'simpan']);
Route::get('/pembayaran/edit/{id}', [\App\Http\Controllers\pembayaranController::class, 'edit']);
Route::post('/pembayaran/update', [\App\Http\Controllers\pembayaranController::class, 'update']);
Route::get('/pembayaran/hapus/{id}', [\App\Http\Controllers\pembayaranController::class, 'hapus']);
});
