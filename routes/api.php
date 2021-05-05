<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContributorController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/category/{id}', [ImageController::class, 'getImagesByCategoryId']);
Route::get('/contributor/{id}', [ContributorController::class, 'getImagesByContributorId']);
Route::get('/image/{id}', [ImageController::class, 'getImageById']);
Route::post('/buy', [OrderController::class, 'buyImage']);
