<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dash\KeuanganController;
use App\Http\Controllers\Api\CallbackController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dash\UserController;
use App\Http\Controllers\Dash\WebsiteController;
use App\Http\Controllers\PostController;

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

# nfbs.or.id
Route::domain(config('app.domain'))
    ->group(function () {
        # Dashboard
        Route::name('dash.')
            ->middleware(['auth', 'permission:lihat dashboard'])
            ->prefix('dashboard')
            ->group(function () {
                Route::view('/', 'dashboard')->name('index');
                Route::view('/users', 'dash.users.index')
                    ->middleware('role:super-admin|admin')
                    ->name('users.index');
                Route::get('/users/{id}', [UserController::class, 'detail'])->name('users.show');
                Route::get('/users/{id}/user-page', [UserController::class, 'userPage'])->name('users.user-page');

                Route::get('/keuangan', [KeuanganController::class, 'index'])
                    ->middleware('permission:lihat billing|edit billing|hapus billing|buat billing')
                    ->name('keuangan.index');

                Route::get('/website', [WebsiteController::class, 'index'])->name('webiste.index');
                Route::get('/website/{item}', [WebsiteController::class, 'views'])->name('webiste.views');
                Route::get('/website/{item}/create', [WebsiteController::class, 'create'])->name('webiste.create');
                Route::get('/website/{item}/{id}/edit', [WebsiteController::class, 'edit'])->name('webiste.edit');
            });


        Route::post('/send-email-reset', [AuthController::class, 'store'])->name('password.username');
        Route::post('/reset-new-password', [AuthController::class, 'update'])->name('password.new');
        Route::post('/payments/callback/spp', [CallbackController::class, 'index']);

        Route::get('/', [PostController::class, 'index'])->name('home');
        Route::get('/videos', [PostController::class, 'videos'])->name('post.videos');
        Route::get('/fasilitas', [PostController::class, 'facilities'])->name('post.facilities');
        Route::get('/artikel', [PostController::class, 'articles'])->name('post.articles');
        Route::get('/{slug}', [PostController::class, 'show'])->name('post.show');
        Route::get('/category/{category}', [PostController::class, 'category'])->name('category');
        Route::get('/author/{author}', [PostController::class, 'author'])->name('author');
        // ajax
        Route::get('/facility/{facility}/get-more', [PostController::class, 'subfacilities'])->name('post.subfacility');
    });

# apps.nfbs.or.id
Route::domain('apps.' . config('app.domain'))
    ->name('user.')
    ->middleware(['auth', 'role:user'])
    ->group(function () {
        Route::view('/', 'user.index')->name('home');
        Route::view('/pembayaran', 'user.pembayaran')->name('pembayaran');
        Route::view('/spp', 'user.spp')->name('spp');
        Route::view('/coming-soon', 'user.coming-soon')->name('coming-soon');
        Route::name('setting.')
            ->prefix('settings')
            ->group(function () {
                Route::view('/', 'user.setting')->name('profile');
            });
    });

# psb.nfbs.or.id
Route::domain('psb.' . config('app.domain'))
    ->name('psb.')
    ->group(function () {
        Route::view('/', 'psb.index')->name('index');
    });
