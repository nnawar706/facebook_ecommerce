<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeSalaryController;
use App\Http\Controllers\MonthController;
use App\Http\Controllers\YearController;
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



Route::get('countries', [CountryController::class, 'index']);

Route::get('cities', [CityController::class, 'index']);

Route::get('year', [YearController::class, 'index']);
Route::post('year', [YearController::class, 'create']);

Route::get('month', [MonthController::class, 'index']);

Route::get('department', [DepartmentController::class, 'index']);
Route::post('department', [DepartmentController::class, 'create']);
Route::put('department/{id}', [DepartmentController::class, 'update']);
Route::delete('department/{id}', [DepartmentController::class, 'delete']);

Route::get('employee', [EmployeeController::class, 'index']);
Route::post('employee', [EmployeeController::class, 'create']);
Route::post('employee/{id}', [EmployeeController::class, 'update']);
Route::delete('employee/{id}', [EmployeeController::class, 'delete']);

Route::post('attendance/check-in', [AttendanceController::class, 'checkIn']);
Route::get('attendance/check-out/{id}', [AttendanceController::class, 'checkOut']);

Route::post('employee/salary', [EmployeeSalaryController::class, 'create']);
