<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ImageController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('adminHome');

    Route::resource('category', CategoryController::class);

    Route::get('/image/approved', [ImageController::class, 'approved'])->name('approvedImages');
    Route::get('/image/moderation', [ImageController::class, 'moderation'])->name('moderationImages');
    Route::get('/image/declined', [ImageController::class, 'declined'])->name('declinedImages');

    Route::get('/image/completed', [ImageController::class, 'completed'])->name('completed');

    Route::patch('/image/approve/{image}', [ImageController::class, 'approve'])->name('imageApprove');
    Route::patch('/image/decline/{image}', [ImageController::class, 'decline'])->name('imageDecline');

    Route::resource('image', ImageController::class);
});

Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');
