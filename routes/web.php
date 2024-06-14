<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\CategoryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
    //return phpinfo();
});
*/


Route::get('/stembayo', function () {
    return "welcome to SIJA";
});

Route::get('/', function () {
    return view('login');
});


Route::resource('barang', BarangController::class)->middleware('auth');
Route::resource('kategori', KategoriController::class)->middleware('auth');
Route::resource('category', CategoryController::class);
Route::resource('barangmasuk', BarangMasukController::class)->middleware('auth');
Route::resource('barangkeluar', BarangKeluarController::class)->middleware('auth');

Route::get('login', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class,'authenticate']);
Route::post('logout', [LoginController::class,'logout']);
Route::get('logout', [LoginController::class,'logout']);

Route::get('register', [RegisterController::class,'create'])->name('register');
Route::post('register', [RegisterController::class,'store']);

Route::get('/dashboard',[DashboardController::class,'index']);

Route::get('/demo1',[DemoController::class,'demo1']);
// Route::get('/hello',[DemoController::class,'hello']);

Route::get('/sija', function () {
    return"Produk Kreatif dan Kewirausahaan";
})->name('pkk');


Route::get('/register', function () {
    return view ('register');
})->name('register');

Route::get('/login', function () {
    return view ('login');
})->name('login');

Route::resource('kategori',KategoriController::class);

Route::resource('barangmasuk',BarangMasukController::class);

Route::resource('barangkeluar',BarangKeluarController::class);

Route::get('/kategori', [KategoriController::class, 'index'])->name('v_kategori.index');







