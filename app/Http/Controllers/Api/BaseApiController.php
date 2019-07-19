<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\People;

class BaseApiController extends Controller
{
    protected $resourceType;

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function get($id)
    {
        return $this->resourceType::find($id);
    }

    public function post(Request $request)
    {
        return;
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
