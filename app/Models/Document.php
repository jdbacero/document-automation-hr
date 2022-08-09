<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_title',
        'document_body',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(DocumentCategory::class, 'category_id');
    }
}
