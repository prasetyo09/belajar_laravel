<?php

use App\Http\Controllers\BelajarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'login']);
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('actionLogin', [LoginController::class, 'actionLogin'])->name('actionLogin');
//Method : GET, POST, PUT, DELETE, PATCH
//GET : Lihat dan Baca
//POST : Mengirim Data dari Form, Aksinya adalah Insert
//PUT : Mengirim Data dari Form, Aksinya adalah Update
//DELETE : Mengirim Data dari Form, Aksinya adalah DELETE
//PATCH : Mengirim Data dari Form, Aksinya adalah UPDATE, UPDATE HANYA 1 DATA!!
Route::get('counting', [BelajarController::class, 'index']);
Route::get('salam', [BelajarController::class, 'greeting']);
Route::get('hitung-tambah', [BelajarController::class, 'indexTambah']);
Route::post('action-tambah', [BelajarController::class, 'tambah'])->name('action-tambah');
Route::get('hitung-kurang', [BelajarController::class, 'indexKurang']);
Route::post('action-kurang', [BelajarController::class, 'kurang'])->name('action-kurang');
Route::get('hitung-kali', [BelajarController::class, 'indexKali']);
Route::post('action-kali', [BelajarController::class, 'kali'])->name('action-kali');
Route::get('hitung-bagi', [BelajarController::class, 'indexbagi']);
Route::post('action-bagi', [BelajarController::class, 'bagi'])->name('action-bagi');

//Peserta
Route::get('peserta', [PesertaController::class, 'index']);
Route::get('create-peserta', [PesertaController::class, 'create'])->name('create-peserta');
Route::post('store-peserta', [PesertaController::class, 'store'])->name('store-peserta');
Route::get('edit-peserta/{id}', [PesertaController::class, 'edit'])->name('edit-peserta');
Route::put('update-peserta/{id}', [PesertaController::class, 'update'])->name('update-peserta');
Route::delete('delete-peserta/{id}', [PesertaController::class, 'delete'])->name('delete-peserta');

//middleware: email dan password
Route::middleware('auth')->group(function(){
    Route::resource('dashboard', DashboardController::class);
    Route::resource('role', RoleController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

//Role
