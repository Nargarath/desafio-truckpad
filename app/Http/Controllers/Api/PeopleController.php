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
            
            $postted = new $this->resourceName(
                $this->resourceType::create([
                    'name' => $peopleReceived['name'],
                    'birth_date' => $peopleReceived['birth_date']
                ])
            );
            
            $peopleCreatedId = $postted->id;

            if(!empty($peopleReceived['documents'])) {
                foreach ($peopleReceived['documents'] as $documentReceived) {
                    $document = new Document;
                    $document->country = $documentReceived['country'];
                    $document->doc_type = $documentReceived['doc_type'];
                    $document->number = $documentReceived['number'];
                    $document->people()->associate($peopleCreatedId);
                    $document->save();
                }
                
            }
            if(!empty($peopleReceived['addresses'])) {
                foreach ($peopleReceived['addresses'] as $addressReceived) {
                    $address = new Address;
                    $address->name = $addressReceived['name'];
                    $address->street_name = $addressReceived['street_name'];
                    $address->street_number = $addressReceived['street_number'];
                    $address->complement = $addressReceived['complement'];
                    $address->postal_code = $addressReceived['postal_code'];
                    $address->neighborhood = $addressReceived['neighborhood'];
                    $address->state = $addressReceived['state'];
                    $address->city = $addressReceived['city'];
                    $address->country = $addressReceived['country'];
                    $address->address_type = $addressReceived['address_type'];
                    $address->people()->associate($peopleCreatedId);
                    $address->save();
                }
            }
            if(!empty($peopleReceived['phones'])) {
                foreach ($peopleReceived['phones'] as $phoneReceived) {
                    $phone = new Phone();
                    $phone->number = $phoneReceived['number'];
                    $phone->people()->associate($peopleCreatedId);
                    $phone->save();
                }
            }
            
            $find = People::with('address','phone','document')->where(['id'=>$peopleCreatedId])->first();
            return response()->json($find , 201);
        }  
        catch (Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
