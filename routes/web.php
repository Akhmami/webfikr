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

Route::view('/', 'welcome')->name('home');
Route::view('users', 'dash.users.index')->name('users.index');
Route::name('dash.')
    ->middleware(['permission:lihat billing'])
    ->prefix('dashboard')
    ->group(function () {
        Route::view('/', 'dashboard')->name('dash.index');
        Route::view('billing', 'dash.keuangan.billing')->name('billing.index');
});
