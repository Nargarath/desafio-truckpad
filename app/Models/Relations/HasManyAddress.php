<?php

namespace App\Models\Relations;

use App\Models\Address;

trait HasManyAddress{

    /**
     * Represents a database relationship
     *
     * @return hasMany|Builder|Address
     */    
    public function address()
    {
        return $this->hasMany(Address::class);
    }
}