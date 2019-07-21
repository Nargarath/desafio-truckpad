<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\People;
use App\Http\Resources\PeopleResource;

class PeopleController extends BaseApiController
{
    public function __construct()
    {
        $this->resourceType = People::class;
        $this->resourceName = PeopleResource::class;
    }

}
