<?php

use App\Http\Controllers\DocumentController;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\User;
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
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
    return redirect('/dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // NOTE: Admin only routes
    Route::group(['middleware' => 'is_admin'], function () {
        Route::get('/document/create', function () {
            $document_categories = cache()->remember("document_categories", now()->addHour(), function () {
                return DocumentCategory::all('category');
            });

            $arr = array_column($document_categories->toArray(), 'category');
            return Inertia::render('DocumentCreate', [
                'tinymce_key' => cache()->rememberForever('tinymce_key', fn () => config('app.tinymce_key')),
                'document_categories' => $arr
            ]);
        });

        Route::get('/document/all', function () {
            return Inertia::render('DocumentList', [
                'documents' => Document::with('category')->paginate(10),
                'categories' => DocumentCategory::all()
            ]);
        });

        Route::get('/users/list', function () {
            return Inertia::render('UsersList', [
                'users' => User::all()
            ]);
        });


        Route::get('/document/edit/{id}', function ($id) {
            $document = Document::with('category')->firstWhere('id', $id);
            if (!$document) {
                abort(404);
            }
            $document_categories = cache()->remember("document_categories", now()->addHour(), function () {
                return DocumentCategory::all('category');
            });

            $arr = array_column($document_categories->toArray(), 'category');

            return Inertia::render('DocumentCreate', [
                'tinymce_key' => cache()->rememberForever('tinymce_key', fn () => config('app.tinymce_key')),
                'document' => $document,
                'document_categories' => $arr
            ]);
        })->whereNumber('id');
    });

    Route::get('/dashboard', function () {
        $fname = Auth::user()->name;
        return Inertia::render('Dashboard', [
            'name' => $fname
        ]);
    })->name('dashboard');


    Route::get('/document/{id}', function ($id) {
        $document = Document::firstWhere('id', $id);
        // FAIL: If not visible or not matching user permissions
        if (!$document || !$document->visible) {
            abort(404);
        }
        if ($document->admin_only && !Auth::user()->is_admin) {
            abort(403);
        }

        return Inertia::render('DocumentView', [
            'tinymce_key' => cache()->rememberForever('tinymce_key', fn () => config('app.tinymce_key')),
            'document' => $document
        ]);
    })->whereNumber('id');
});

// REMOVE: This is for dev purposes. Remove upon building to production.
Route::get('/csrf', function () {
    return csrf_token();
});

Route::get('/user', function () {
    return Auth::user()->is_admin;
});

require __DIR__ . '/auth.php';
