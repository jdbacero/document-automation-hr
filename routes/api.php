<?php

use App\Http\Controllers\DocumentCategoryController;
use App\Http\Controllers\DocumentController;
use App\Models\Document;
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

Route::group(['middleware' => ['auth:sanctum']], function () {
    // NOTE: Protected API routes.
    Route::group(['middleware' => 'is_admin'], function () {
        Route::post('/document/save', [DocumentController::class, 'store']);
        // Route::put('/document/update/{document}', function(Document $document) {

        // });
        Route::put('/document/update/{document}', [DocumentController::class, 'update']);
        Route::put('/document/visibility/{id}', [DocumentController::class, 'toggleVisibility']);
        Route::put('/document/admin/{id}', [DocumentController::class, 'togglePermission']);
    });
    Route::post('/document/categories', [DocumentCategoryController::class, 'getAll']);
});
