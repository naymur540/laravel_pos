<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\CatagorieController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resources([
    'orders'=>OrderController::class,
    'orderdetails'=>OrderDetailController::class,
    'catagories'=>CatagorieController::class,
    'companies'=>CompanyController::class,
    'products'=>ProductController::class,
    'users'=>UserController::class,
    'transactions'=>TransactionController::class


]);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/barcode', [ProductController::class, 'getBarCode'])->name('products.barcode');

