<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends BaseApiController
{

    public function __construct()
    {
        $this->resourceType = Address::class;
    }
}
