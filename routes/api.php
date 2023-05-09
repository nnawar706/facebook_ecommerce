<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FacebookPostsController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('auth/FacebookPosts', [FacebookPostsController::class, 'authenticateUser']);
//Route::get('auth/FacebookPosts/callback', [FacebookPostsController::class, 'handleCallback']);

Route::get('facebook/user/info', [UserController::class, 'getUserInfo']);
Route::get('facebook/page/info', [FacebookPostsController::class, 'getPageInfo']);
Route::get('facebook/page/permissions', [FacebookPostsController::class, 'permissionList']);
Route::get('facebook/page/products', [FacebookPostsController::class, 'getProducts']);
Route::get('facebook/page/products/{product_id}', [FacebookPostsController::class, 'readProduct']);
Route::post('facebook/page/products', [FacebookPostsController::class, 'createProduct']);
Route::put('facebook/page/products/{product_id}', [FacebookPostsController::class, 'updateProduct']);
Route::delete('facebook/page/products/{product_id}', [FacebookPostsController::class, 'deleteProduct']);
