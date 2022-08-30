<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentRequest $request)
    {
        $save = Document::create(
            $request->validated()
        );

        if ($save) {
            // SUCCESS: Save success code
            return true;
        } else {
            // FAIL: Saving failed code
            return false;
        }
    }

    public function toggleVisibility($id)
    {
        $visible = Document::firstWhere('id', $id)->visible;
        if ($visible) {
            Document::where('id', $id)->update(['visible' => 0]);
        } else if (!$visible) {
            Document::where('id', $id)->update(['visible' => 1]);
        } else {
            abort(500);
        }
    }

    public function togglePermission($id)
    {
        // if (Auth::is_admin()) {
        if (true) {
            $admin_only = Document::firstWhere('id', $id)->admin_only;
            if ($admin_only) {
                Document::where('id', $id)->update(['admin_only' => 0]);
            } else if (!$admin_only) {
                Document::where('id', $id)->update(['admin_only' => 1]);
            } else {
                abort(500);
            }
            return true;
        }
        return false;
    }

    public function test(Request $request)
    {
        // echo json_encode($request);
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentRequest  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
}
