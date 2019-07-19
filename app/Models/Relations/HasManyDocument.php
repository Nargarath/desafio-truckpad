<?php

namespace App\Models\Relations;

use App\Models\Document;

trait HasManyDocument{

    /**
     * Represents a database relationship
     *
     * @return hasMany|Builder|Document
     */    
    public function document()
    {
        return $this->hasMany(Document::class);
    }
}