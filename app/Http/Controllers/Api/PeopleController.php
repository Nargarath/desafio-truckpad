<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\People;

class PeopleController extends BaseApiController
{
    public function __construct()
    {
        $this->resourceType = People::class;
    }
}
