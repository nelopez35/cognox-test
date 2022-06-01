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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


#Own Transactions
Route::get('/make-transaction', [\App\Http\Controllers\OwnTransactionController::class, 'show'])
    ->name('make-transaction');
Route::post('/do-transaction', [\App\Http\Controllers\OwnTransactionController::class, 'perform'])
    ->name('do-transaction');

#External Transactions
Route::get('/make-external-transaction', [\App\Http\Controllers\ExternalTransactionController::class, 'show'])
    ->name('make-external-transaction');
Route::post('/make-external-transaction', [\App\Http\Controllers\ExternalTransactionController::class, 'perform'])
    ->name('do-external-transaction');
