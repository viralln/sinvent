<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('kategori', [KategoriController::class, 'getAPIKategori']);

Route::post('kategori', [KategoriController::class, 'createAPIKategori']);

Route::get('kategori/{id}', [KategoriController::class, 'getAPIOneKategori']);

Route::delete('/kategori/{id}', [KategoriController::class, 'deleteAPIKategori']);

Route::put('kategori/{id}', [KategoriController::class, 'updateAPIKategori']);
