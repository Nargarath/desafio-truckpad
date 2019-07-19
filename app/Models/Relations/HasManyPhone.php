<?php

namespace App\Models\Relations;

use App\Models\Phone;

trait HasManyPhone{

    /**
     * Represents a database relationship
     *
     * @return hasMany|Builder|Document
     */    
    public function phone()
    {
        return $this->hasMany(Phone::class);
    }
}