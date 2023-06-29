<?php

use App\Http\Controllers\barang_masukController;
use App\Http\Controllers\barangController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\keranjangController;
use App\Http\Controllers\supplierController;
use App\Http\Controllers\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('kategori/get', [kategoriController::class, 'get_kategori']);
Route::post('kategori/add', [kategoriController::class, 'insert_kategori']);
Route::post('kategori/update', [kategoriController::class, 'update_kategori']);

Route::post('barang/insert', [barangController::class, 'insert_barang']);
Route::get('barang/get_list', [barangController::class, 'get_list_barang']);
Route::delete('barang/delete/{id}', [barangController::class, 'delete_barang']);
Route::post('barang/update', [barangController::class, 'update_barang']);

Route::post('supplier/insert', [supplierController::class, 'insert_supplier']);

Route::post('barangmasuk/insert', [barang_masukController::class, 'insert_barang_masuk']);

Route::post('user/login', [userController::class, 'login']);
Route::post('user/register', [userController::class, 'register']);
Route::get('user/get_user', [userController::class, 'get_user']);
Route::delete('user/delete/{id}', [userController::class, 'delete_user']);

Route::post('keranjang/insert', [keranjangController::class, 'insert_keranjang']);
Route::get('keranjang/get_kode/{kode_keranjang}', [keranjangController::class, 'get_kode_keranjang']);