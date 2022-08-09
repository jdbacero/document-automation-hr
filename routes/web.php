<?php

use App\Http\Controllers\DocumentController;
use App\Models\DocumentCategory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $fname = Auth::user()->name;
        return Inertia::render('Dashboard', [
            'name' => $fname
        ]);
    })->name('dashboard');

    Route::get('/document/create', function () {
        $document_categories = cache()->remember("document_categories", now()->addHour(), function () {
            return DocumentCategory::all('category');
        });

        $arr = array_column($document_categories->toArray(), 'category');
        return Inertia::render('CreateDocument', [
            'tinymce_key' => config('app.tinymce_key'),
            'document_categories' => $arr
        ]);
    });

    // FIXME: Site settings should be for users with admin priviledges
    Route::get('/site/settings', function () {
        return Inertia::render('HelloWorld');
    });
});



// REMOVE: This is for dev purposes. Remove upon building to production.
Route::get('/csrf', function () {
    return csrf_token();
});

require __DIR__ . '/auth.php';
