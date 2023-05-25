<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/transaction', TransactionController::class);
Route::post('/transaction/pay', [Transaction::class, 'pay'])->name('transaction.pay');

Route::resource('/category', CategoryController::class);
Route::resource('/account', AccountController::class);
Route::resource('/payment', PaymentController::class);