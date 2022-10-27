<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dash\UserController;
use App\Http\Controllers\Dash\WebsiteController;
use App\Http\Controllers\Dash\DashboardController;
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

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// # nfbs.or.id
# Dashboard
Route::name('dash.')
    ->middleware(['auth', 'permission:lihat dashboard'])
    ->prefix('dashboard')
    ->group(function () {
        Route::get('/', DashboardController::class)->name('index');
        Route::view('/users', 'dash.users.index')
            ->middleware('role:super-admin|admin')
            ->name('users.index');
        Route::get('/users/{id}', [UserController::class, 'detail'])->name('users.show');
        Route::get('/users/{id}/user-page', [UserController::class, 'userPage'])->name('users.user-page');
        Route::get('/', [WebsiteController::class, 'index'])->name('index');
        Route::get('/{item}', [WebsiteController::class, 'views'])->name('views');
        Route::get('/{item}/create', [WebsiteController::class, 'create'])->name('create');
        Route::get('/{item}/{id}/edit', [WebsiteController::class, 'edit'])->name('edit');
    });

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/faq', [PostController::class, 'faq'])->name('faq');
// Route::get('/videos', [PostController::class, 'videos'])->name('post.videos');
// Route::get('/fasilitas', [PostController::class, 'facilities'])->name('post.facilities');
Route::get('/artikel', [PostController::class, 'articles'])->name('post.articles');
Route::get('/{slug}', [PostController::class, 'show'])->name('post.show');
Route::get('/category/{category}', [PostController::class, 'category'])->name('category');
Route::get('/author/{author}', [PostController::class, 'author'])->name('author');
// ajax
Route::get('/facility/{facility}/get-more', [PostController::class, 'subfacilities'])->name('post.subfacility');

# rekrutmen.nfbs.or.id
Route::domain('rekrutmen.' . config('app.domain'))
    ->group(function () {
        Route::get('/', function () {
            return redirect()->away('https://forms.gle/GrUe7TjF4rV4dWCz6');
        });
    });
