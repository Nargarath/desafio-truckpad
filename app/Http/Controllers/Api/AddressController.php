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

    public function getAddressByPostalCode($postal) {
        $client = new \GuzzleHttp\Client();
        $response = $client->get("https://viacep.com.br/ws/$postal/json");
        $body = $response->getBody();
        return response()->json($body);
    }
}
