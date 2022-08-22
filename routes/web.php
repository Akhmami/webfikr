<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dash\KeuanganController;
// use App\Http\Controllers\Api\CallbackController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BajuController;
use App\Http\Controllers\Dash\IDCardController as DashIDCardController;
use App\Http\Controllers\Dash\PostPsbController;
use App\Http\Controllers\Dash\StatusPsbController;
use App\Http\Controllers\Dash\UserController;
use App\Http\Controllers\Dash\WebsiteController;
use App\Http\Controllers\Dash\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PsbController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\IDCardController;
use App\Http\Controllers\UploadController;

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

# nfbs.or.id
Route::domain(config('app.domain'))
    ->group(function () {
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

                # Keuangan
                Route::get('/keuangan', [KeuanganController::class, 'index'])
                    ->middleware('permission:lihat billing|edit billing|hapus billing|buat billing')
                    ->name('keuangan.index');
                Route::view('/keuangan/report', 'dash.keuangan.report')->name('keuangan.report');
                Route::view('/keuangan/riwayat-webhook', 'dash.keuangan.webhook')->name('keuangan.webhook');
                Route::post('/keuangan/proses-ulang-webhook', [KeuanganController::class, 'resendWebhook'])->name('keuangan.resend-webhook');
                Route::get('/keuangan/pas-card/{jenjang}/{skip}', [DashIDCardController::class, 'index'])->name('keuangan.pas-card');
                Route::view('/keuangan/spp-gagal-dibuat', 'dash.keuangan.spp-failed')->name('keuangan.spp-failed');
                Route::post('/keuangan/spp-gagal-dibuat', [KeuanganController::class, 'recreateSPP'])->name('keuangan.recreate-spp');

                # PSB
                Route::view('/psb', 'dash.psb.index')->middleware('permission:lihat psb')->name('psb.index');
                Route::view('/psb/status-psb', 'dash.psb.status-psb-index')->middleware('permission:lihat psb')->name('psb.status-psb-index');
                Route::get('/psb/status-psb/{id}/edit', [StatusPsbController::class, 'edit'])->middleware('permission:lihat psb')->name('psb.status-psb-edit');
                Route::put('/psb/status-psb/{id}', [StatusPsbController::class, 'update'])->middleware('permission:lihat psb')->name('psb.status-psb-update');
                Route::get('/psb/posts', [PostPsbController::class, 'index'])->middleware('permission:lihat psb')->name('psb.posts-index');
                Route::put('/psb/posts/{id}', [PostPsbController::class, 'update'])->middleware('permission:lihat psb')->name('psb.posts-update');
                Route::view('/psb/vouchers', 'dash.psb.vouchers-index')->middleware('permission:lihat psb')->name('psb.vouchers-index');
                Route::view('/psb/settings', 'dash.psb.settings-index')->middleware('permission:lihat psb')->name('psb.settings-index');

                # Website
                # route: dashboard/website
                Route::name('website.')
                    ->prefix('website')
                    ->middleware('permission:lihat artikel')
                    ->group(function () {
                        Route::get('/', [WebsiteController::class, 'index'])->name('index');
                        Route::get('/{item}', [WebsiteController::class, 'views'])->name('views');
                        Route::get('/{item}/create', [WebsiteController::class, 'create'])->name('create');
                        Route::get('/{item}/{id}/edit', [WebsiteController::class, 'edit'])->name('edit');
                    });
            });

        Route::post('/send-email-reset', [AuthController::class, 'store'])->name('password.username');
        Route::post('/reset-new-password', [AuthController::class, 'update'])->name('password.new');
        // Route::post('/payments/callback/spp', [CallbackController::class, 'index']);
        Route::get('/', [PostController::class, 'index'])->name('home');
        Route::get('/faq', [PostController::class, 'faq'])->name('faq');
        // Route::get('/videos', [PostController::class, 'videos'])->name('post.videos');
        // Route::get('/fasilitas', [PostController::class, 'facilities'])->name('post.facilities');
        Route::get('/artikel', [PostController::class, 'articles'])->name('post.articles');
        Route::get('/{slug}', [PostController::class, 'show'])->name('post.show');
        Route::get('/category/{category}', [PostController::class, 'category'])->name('category');
        Route::get('/author/{author}', [PostController::class, 'author'])->name('author');
        # Survey
        Route::get('/survey/{uri}', [SurveyController::class, 'index'])->name('survey');
        Route::post('/survey/{id}', [SurveyController::class, 'store'])->name('survey.store');
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
        // Route::view('/berkas', 'user.berkas')->name('berkas');
        Route::view('/spp', 'user.spp')->name('spp');
        Route::view('/pas', 'user.pas')->name('pas');
        Route::get('/berkas', [UploadController::class, 'index'])->name('berkas');
        Route::post('/berkas/store', [UploadController::class, 'store'])->name('berkas.store');
        Route::get('/berkas/{nama}', [UploadController::class, 'show'])->name('berkas.show');
        Route::get('/ukuran-baju', [BajuController::class, 'index'])->name('baju');
        Route::post('/ukuran-baju', [BajuController::class, 'store'])->name('baju.store');
        Route::get('/pas/print/{id}', [IDCardController::class, 'index'])->name('pas.print');
        # Survey
        Route::get('/survey/{uri}', [SurveyController::class, 'index'])->name('survey');
        Route::post('/survey/{id}', [SurveyController::class, 'store'])->name('survey.store');
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
        Route::get('/', [PsbController::class, 'index'])->name('index');
        Route::get('/internal', [PsbController::class, 'internal'])->name('internal');
        Route::get('/{title}', [PsbController::class, 'show'])->name('show');

        // Route::get('ensb0w6p5vqylbdd0xvpj24i3', 'PsbController@gelombangTertutup')->name('psb.tertutup');
        Route::get('users/d/{string}', [PsbController::class, 'verify'])->name('verify');
    });

# mutasi.nfbs.or.id
Route::domain('mutasi.' . config('app.domain'))
    ->name('mutasi.')
    ->group(function () {
        Route::get('/', [MutasiController::class, 'index']);
    });

# rekrutmen.nfbs.or.id
Route::domain('rekrutmen.' . config('app.domain'))
    ->group(function () {
        Route::get('/', function () {
            return redirect()->away('https://forms.gle/GrUe7TjF4rV4dWCz6');
        });
    });
