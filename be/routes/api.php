<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BillboardController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;

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

// Authenticate user
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Authenticate admin
Route::post('/admin/login', [AuthController::class, 'authAdmin']);
Route::get("/admin/dashboard", [AdminController::class, 'data'])->middleware(['auth:api', 'admin']);

// Route::get('/billboards', [BillboardController::class, 'index'])->middleware("auth:api");
// Route::post('/billboards', [BillboardController::class, 'store'])->middleware("auth:api");

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->middleware('auth:api');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->middleware('auth:api');
Route::post('/admin/categories', [CategoryController::class, 'store'])->middleware(['auth:api', 'admin']);
Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])->middleware(['auth:api', 'admin']);
Route::put('/admin/categories/{id}', [CategoryController::class, 'update'])->middleware(['auth:api', 'admin']);

// Articles
Route::get('/articles', [ArticleController::class, 'index'])->middleware('auth:api');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->middleware('auth:api');
Route::post('/admin/articles', [ArticleController::class, 'store'])->middleware(['auth:api', 'admin']);

// Posts
Route::get('/posts', [PostController::class, 'index'])->middleware('auth:api');
Route::get('/posts/{id}', [PostController::class, 'show'])->middleware('auth:api');
Route::post('/posts', [PostController::class, 'store'])->middleware("auth:api");
Route::put('/posts/{id}', [PostController::class, 'update'])->middleware("auth:api");
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware("auth:api");
