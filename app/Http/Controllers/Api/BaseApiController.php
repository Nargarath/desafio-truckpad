<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\People;
use App\Http\Resources\PeopleResource;
use App\Http\Resources\DocumentResource;
use App\Http\Resources\AddressResource;
use App\Http\Resources\PhoneResource;

class BaseApiController extends Controller
{
    protected $resourceType;
    protected $resourceName;

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function get($id)
    {
        return $this->resourceName::collection(
            $this->resourceType::find($id)
        );
    }

    public function post(Request $request)
    {
        return $this->resourceName::collection(
            $this->resourceType::create($request->all())
        );
    }

    public function put(Request $request)
    {
        return;
    }

    public function patch(Request $request)
    {
        return;
    }

    public function delete($id)
    {
        return;
    }

    public function datatable(Request $request)
    {
        return;
    }
}
