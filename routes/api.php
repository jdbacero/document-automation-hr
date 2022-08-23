<?php

use App\Http\Controllers\DocumentCategoryController;
use App\Http\Controllers\DocumentController;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

// TODO: Add authentication
Route::post('/document/save', [DocumentController::class, 'store']);
Route::post('/document/update', [DocumentController::class, 'store']);
Route::post('/document/categories', [DocumentCategoryController::class, 'getAll']);
// Route::get('/test', [DocumentCategoryController::class, 'getAll']);
