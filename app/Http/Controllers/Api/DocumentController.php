<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends BaseApiController
{
    public function __construct()
    {
        $this->resourceType = Document::class;
    }
}
