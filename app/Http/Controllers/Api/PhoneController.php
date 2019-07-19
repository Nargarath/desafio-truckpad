<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Phone;
class PhoneController extends BaseApiController
{
    public function __construct()
    {
        $this->resourceType = Phone::class;
    }
}
