<?php

namespace App\Http\Controllers;

use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentCategoryController extends Controller
{
    //
    public function getAll(Request $req)
    {
        if (isset($req->is_admin)) {
            if ($req->is_admin === 0) {
                return DocumentCategory::with(
                    [
                        'documents' => function ($query) use ($req) {
                            $query->where('admin_only', 0)
                                ->where('visible', 1);
                        }
                    ]
                )->where('enabled', 1)->get();
            }
            return DocumentCategory::with(
                [
                    'documents' => function ($query) use ($req) {
                        $query->where('visible', 1);
                    }
                ]
            )->where('enabled', 1)->get();
        } else {
            return DocumentCategory::with(
                [
                    'documents' => function ($query) use ($req) {
                        $query->where('visible', 1);
                    }
                ]
            )->where('enabled', 1)->get();
        }
    }
}
