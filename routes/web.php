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

Route::domain(config('app.domain'))
    ->group(function () {
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
});

Route::domain('apps.' . config('app.domain'))
    ->name('user.')
    ->middleware(['auth', 'role:user'])
    ->group(function () {
        Route::view('/', 'user.index')->name('home');
        Route::view('/pembayaran', 'user.pembayaran')->name('pembayaran');
        Route::view('/spp', 'user.spp')->name('spp');
        Route::view('/lainnya', 'user.lainnya')->name('lainnya');
});
