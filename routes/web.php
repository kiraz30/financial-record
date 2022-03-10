<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([

    //untuk menonaktifakan fitur register dan reset
    'register'=> false,
    'reset'=> false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//---Crud KATEGORI---//
Route::get('/kategori',[HomeController::class,'kategori']);
//input datKATEGORI
Route::get('/kategori/tambah',[HomeController::class,'kategori_tambah']);
//store data kategori
Route::post('/kategori/aksi',[HomeController::class,'kategori_aksi']);
//edit data kategori
Route::get('/kategori/edit/{id}',[HomeController::class,'kategori_edit']);
//Update data
Route::put('/kategori/update/{id}',[HomeController::class,'kategori_update']);
//hapus data kategori
Route::get('kategori/hapus/{id}',[HomeController::class,'kategori_hapus']);

//---Crud TRANSAKSI---//
Route::get('/transaksi',[HomeController::class,'transaksi']);
//Input data TRansaksi
Route::get('/transaksi/tambah',[HomeController::class,'transaksi_tambah']);
//store data
Route::post('/transaksi/aksi',[HomeController::class,'transaksi_aksi']);
//Edit data
Route::get('/transaksi/edit/{id}',[HomeController::class,'transaksi_edit']);
//Update data
Route::put('/transaksi/update/{id}',[HomeController::class,'transaksi_update']);
//hapus data
Route::get('/transaksi/hapus/{id}',[HomeController::class,'transaksi_hapus']);
//Cari data transaksi
Route::get('/transaksi/cari',[HomeController::class,'transaksi_cari']);

//---Crud lAPORAN---//
Route::get('/laporan',[HomeController::class,'laporan']);
//laoran hasil
Route::get('/laporan/hasil',[HomeController::class,'laporan_hasil']);
//print laporan
Route::get('/laporan/print',[HomeController::class,'laporan_print']);
//Export Excel
Route::get('/laporan/excel',[HomeController::class,'laporan_excel']);

//Ganti password
Route::get('/ganti_password',[HomeController::class,'ganti_password']);
//update
Route::post('/ganti_password/aksi',[HomeController::class,'ganti_password_aksi']);
