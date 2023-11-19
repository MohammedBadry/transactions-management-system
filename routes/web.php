<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Transactions;
use App\Http\Controllers\Backend\Payments;
use App\Http\Controllers\Backend\Reports;

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

Route::get('/', function () {
    return redirect('login');
});
Route::get('need/permission', function () {
    return view('no_permission');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
])->group(function () {
    Route::resource('transactions', Transactions::class);
    Route::resource('payments', Payments::class);
    Route::get('reports', [Reports::class, 'index'])->name('reports.index');
    Route::post('reports/generate', [Reports::class, 'generate'])->name('reports.generate');
});
