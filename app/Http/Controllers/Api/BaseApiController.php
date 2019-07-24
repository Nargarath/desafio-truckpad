<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\People;
use App\Http\Resources\PeopleResource;
use App\Http\Resources\DocumentResource;
use App\Http\Resources\AddressResource;
use App\Http\Resources\PhoneResource;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
       
        return new $this->resourceName(
            $this->resourceType::findOrFail($id)
        );
    
    }

    public function post(Request $request)
    {
        try {
            $postted = new $this->resourceName(
                $this->resourceType::create($request->all())
            );

            return response()->json($postted, 201);
        }  
        catch (Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function put(Request $request)
    {
        try {
            $putted =  new $this->resourceName(
                $this->resourceType::update($request->all())
            );
            return response()->json($putted, 200);
        }
        catch (Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function patch(Request $request)
    {
        try {
            $patched =  new $this->resourceName(
                $this->resourceType::update($request->all())
            );
            return response()->json($patched, 200);
        }
        catch (Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            $deleted = $this->resourceType::find($id);
            if ($deleted) 
            {
                $deleted->delete(); 
            } 
            else 
            {
                return response()->json(true,204);
            }           
        }
        catch (ModelNotFoundException $ex) 
        {
            throw $ex;
        }
        catch (Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function datatable(Request $request)
    {
        extract($request->all());
        
        $datatable = $this->resourceType::orderBy($sortField??'id', $sortOrder??'desc');
        
        

        if (!empty($search) && $search !== '{}')
        {
            $search = json_decode($search,true);
            $datatable = $datatable->where($search['searchable'],'like',"%".$search['search']."%");
        }
        
        
        return $datatable->paginate($results??10);
    }
}
