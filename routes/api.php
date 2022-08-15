<?php

use App\Http\Controllers\DocumentController;
use App\Models\DocumentCategory;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// TODO: Add authentication
Route::post('/document/save', [DocumentController::class, 'store']);
Route::post('/document/categories', function () {
    return DocumentCategory::with('documents')->get()->toJson();
});
