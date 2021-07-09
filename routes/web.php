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
Route::name('dash.')
    ->middleware(['auth', 'permission:lihat dashboard'])
    ->prefix('dashboard')
    ->group(function () {
        Route::view('/', 'dashboard')->name('index');
        Route::view('users', 'dash.users.index')
            ->middleware('role:super-admin|admin')
            ->name('users.index');
        Route::view('billing', 'dash.keuangan.billing')
            ->middleware('permission:lihat billing|edit billing|hapus billing|buat billing')
            ->name('billing.index');
});
