<?php

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

Route::get('/', 'AuthController@index');
Route::post('/', 'AuthController@store');
Route::get('/logout', 'AuthController@logout');
Route::get('/coba', 'AuthController@create');

Route::get('/antrian','HomeController@index');
Route::get('/antrian/{id}','HomeController@show');
Route::post('/antrian','HomeController@ajaxShow');



// Awal Route Superadmin
Route::get('/superadmin','SuperadminController@getTambahUser');

Route::get('/superadmin/user','SuperadminController@getAdmin');
Route::get('/superadmin/user/tambah','SuperadminController@getTambahUser');
Route::post('/superadmin/user/tambah','SuperadminController@postTambahUser');

Route::get('/superadmin/jnscheckup','SuperadminController@getJnscheckup');
Route::get('/superadmin/jnscheckup/tambah','SuperadminController@getTambahJnscheckup');
Route::post('/superadmin/jnscheckup/tambah','SuperadminController@postTambahJnscheckup');

// Akhir Route Superadmin

// Awal Route Admin
Route::get('/admin','AdminController@index');

Route::get('/admin/pasien','AdminController@getPasien');
Route::post('/admin/pasien','AdminController@postPasien');

Route::get('/admin/pasien/daftar-checkup/{id}','AdminController@viewDaftar');

Route::post('/admin/pasien/daftar-checkup','AdminController@ajaxDaftar');
Route::post('/admin/pasien/daftar-checkup-batal','AdminController@ajaxBatalDaftar');

Route::post('/admin/pasien/daftar-checkup-bayar','AdminController@bayarCheckup');

Route::get('/admin/pasien/riwayat/{id}','AdminController@getRiwayat');

Route::get('/admin/pembayaran','AdminController@getPembayaran');

Route::get('/admin/pembayaran/{kode}','AdminController@getDetailPembayaran');

// Akhir Route Admin

// Awal Route Pegawai
Route::get('/pegawai','PegawaiController@index');


Route::get('/pegawai/antrian','PegawaiController@antrian');
Route::get('/pegawai/antrian/{id}','PegawaiController@getAntrian');

Route::get('/pegawai/antrian/detail/{id}','PegawaiController@detailAntrian');
Route::post('/pegawai/antrian/detail','PegawaiController@postLaporan');

Route::post('/pegawai/antrianAjax','PegawaiController@ajaxAntrian');


// Akhir Route Pegawai
