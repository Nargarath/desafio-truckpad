<?php

namespace App\Models\Relations;

use App\Models\People;

trait BelongsToPeople{

    /**
     * Represents a database relationship
     *
     * @return belongsTo|Builder|People
     */    
    public function people()
    {
        return $this->belongsTo(People::class);
    }
}