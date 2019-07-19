<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Relations\BelongsToPeople;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Enums\AddressEnum;

class Address extends Model
{
    use BelongsToPeople,
        SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'name',
        'street_name',
        'street_number',
        'complement',
        'postal_code',
        'neighborhood',
        'state',
        'city',
        'country',
        'address_type',
    ];
}
