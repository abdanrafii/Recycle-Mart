<?php

namespace Modules\Shop\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\UuidTrait;

class Address extends Model
{
    use HasFactory, UuidTrait;

    protected $table = 'shop_addresses';

    protected $fillable = [
        'user_id',
        'is_primary',
        'label',
        'first_name',
        'last_name',
        'address1',
        'address2',
        'phone',
        'email',
        'city',
        'province',
        'postcode'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Shop\Database\factories\AddressFactory::new();
    }
}
