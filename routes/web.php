<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrencyConverterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginSecurityController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});
Route::get('filter', [PostController::class, 'filter']);
Route::get('posts/file-upload', [PostController::class, 'uploadFile'])->name('posts.fileupload');
Route::post('posts/file-upload', [PostController::class, 'uploadVideo'])->name('posts.uploadVideo');
Route::resource('posts', PostController::class);
Route::get('currency', [CurrencyConverterController::class, 'index']);
Route::post('currency', [CurrencyConverterController::class, 'exchangeCurrency']);
Route::group(['prefix' => '2fa'], function () {
    Route::get('/', [LoginSecurityController::class, 'show2faForm']);
    Route::post('/generateSecret', [LoginSecurityController::class, 'generate2faSecret'])->name('generate2faSecret');
    Route::post('/enable2fa', [LoginSecurityController::class, 'enable2fa'])->name('enable2fa');
    Route::post('/disable2fa', [LoginSecurityController::class, 'disable2fa'])->name('disable2fa');

    // 2fa middleware
    Route::post('/2faVerify', function () {
        return redirect(URL()->previous());
    })->name('2faVerify')->middleware('2fa');
});

// test middleware
Route::get('/test_middleware', function () {
    return "2FA middleware work!";
})->middleware(['auth', '2fa']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::view('newfilter', 'newfilter');
