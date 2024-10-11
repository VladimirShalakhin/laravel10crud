<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::resource('users', UserController::class)->only([
    'store',
    'update',
    'destroy',
]);
Route::resource('companies', CompanyController::class)->only([
    'store',
    'update',
    'destroy',
]);
Route::resource('comments', CommentController::class)->only([
    'store',
    'update',
    'destroy',
]);
Route::get('/companies/best', [CompanyController::class, 'getBest']);
