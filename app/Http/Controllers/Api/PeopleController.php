<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\People;
use App\Http\Resources\PeopleResource;
use App\Models\Document;
use App\Models\Phone;
use App\Models\Address;

class PeopleController extends BaseApiController
{
    public function __construct()
    {
        $this->resourceType = People::class;
        $this->resourceName = PeopleResource::class;
    }

    public function post(Request $request)
    {
        try {
            $peopleReceived = $request->all();
            
            $return = $this->resourceType::create($peopleReceived);
            if (!empty($peopleReceived['document'])) {
                $return->document()->create(...$peopleReceived['document']);
            }
            if (!empty($peopleReceived['phone'])) {
                $return->phone()->create(...$peopleReceived['phone']);
            }
            if (!empty($peopleReceived['address'])) {
                $return->address()->create(...$peopleReceived['address']);
            }
            $postted = new $this->resourceName(
                $return
            );
            return response()->json($postted , 201);
        }  
        catch (Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function put($id,Request $request)
    {        
        try {
            $updated = $this->resourceType::find($id)->update($request->all());
            $putted =  new $this->resourceName(
                $this->resourceType::find($id)
            );
            return response()->json($putted, 200);
        }
        catch (Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function datatable(Request $request)
    {
        extract($request->all());
        
        $datatable = $this->resourceType::with('document','phone','address')->orderBy($sortField??'id', $sortOrder??'desc');
        
        if (!empty($search) && $search !== '{}' && $search !== '{"search":"","searchable":""}')
        {
            $search = json_decode($search,true);
            $datatable = $datatable->where($search['searchable'],'like',"%".$search['search']."%");
        }
        
        
        return $datatable->paginate($results??10);
    }

    public function deleteIfDontReceive($model,$dataReceived) {
        
    }
}
