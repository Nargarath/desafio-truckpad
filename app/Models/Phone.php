<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Relations\BelongsToPeople;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use BelongsToPeople,
        SoftDeletes;
        
    protected $fillable = [
        'prefix',
        'number',
        'priority'
    ];
}
