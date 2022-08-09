<?php

namespace App\Http\Requests;

use App\Models\DocumentCategory;
use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO: Make sure to authorize specific users ie: admin
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'document_title' => ['required', 'string'],
            'document_body' => ['required', 'string'],
            'category_id' => ['integer']
        ];
    }

    protected function prepareForValidation()
    {
        /* NOTE: Get document category sent from client-side, and check for existing
        NOTE: category. If it does not exist, create the category. Get category ID and save to document. */
        $document_category = $this->document_category;
        if (!DocumentCategory::where('category', $document_category)->exists()) {
            $category = DocumentCategory::create(['category' => $document_category]);
        } else {
            $category = DocumentCategory::firstWhere(['category' => $document_category]);
        }
        $this->merge([
            'category_id' => $category->id
        ]);
    }
}
