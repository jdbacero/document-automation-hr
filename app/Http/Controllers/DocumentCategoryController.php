<?php

namespace App\Http\Controllers;

use App\Models\DocumentCategory;
use Illuminate\Http\Request;

class DocumentCategoryController extends Controller
{
    //
    public static function getAll()
    {
        return DocumentCategory::with('documents')->get();
    }
}
