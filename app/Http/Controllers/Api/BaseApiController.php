<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class BaseApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
}
