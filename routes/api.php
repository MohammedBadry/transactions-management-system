<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Transactions;
use App\Http\Controllers\Api\Payments;
use App\Http\Controllers\Api\Reports;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);

Route::middleware([
    'auth:sanctum',
])->group(function () {
    Route::resource('transactions', Transactions::class);
    Route::resource('payments', Payments::class);
    Route::post('generate-report', [Reports::class, 'generate'])->name('reports.generate');
});

