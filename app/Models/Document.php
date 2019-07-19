<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Relations\BelongsToPeople;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Enums\DocumentEnum;

class Document extends Model
{
    use BelongsToPeople,
        SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'country',
        'doc_type',
        'number',
        'additional_infos'
    ];
    
}
