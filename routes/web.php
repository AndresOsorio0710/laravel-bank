<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionOtherAccountController;
use App\Http\Controllers\TransactionOwnAccountController;

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
    return view('home');
})->middleware('auth')->name('home');

//Authentication
Route::get('/register',[RegisterController::class, 'create'])->middleware('guest')->name('register.index');
Route::post('/register',[RegisterController::class, 'store'])->name('register.store');

Route::get('/login',[SessionsController::class, 'create'])->middleware('guest')->name('login.index');
Route::post('/login',[SessionsController::class, 'store'])->name('login.store');
Route::get('/logout',[SessionsController::class, 'destroy'])->middleware('auth')->name('login.destroy');


//Account
//Transaction
Route::get('/account',[AccountController::class, 'create'])->middleware('auth')->name('account.index');
Route::post('/account',[AccountController::class, 'store'])->middleware('auth')->name('account.store');

//Transaction
Route::get('/transaction',[TransactionController::class, 'create'])->middleware('auth')->name('transaction.index');

// Own Account
Route::get('/transaction_own_account',[TransactionOwnAccountController::class, 'create'])->middleware('auth')->name('transaction_own_account.index');
Route::post('/transaction_own_account',[TransactionOwnAccountController::class, 'store'])->middleware('auth')->name('transaction_own_account.store');

// Other Account
Route::get('/transaction_other_account',[TransactionOtherAccountController::class, 'create'])->middleware('auth')->name('transaction_other_account.index');