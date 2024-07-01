<?php

namespace Modules\Shop\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\UuidTrait;

class Shop extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'owner_id',
		'name',
		'slug',
        'featured_image',
		'excerpt',
		'body',
    ];

    protected $table = 'shop_shops';

    public function ow()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function products()
    {
        return $this->hasMany('Modules\Shop\Entities\Product', 'product_id')->orderBy('price', 'ASC');
    }

    public function images()
	{
		return $this->hasMany('Modules\Shop\Entities\ProductImage', 'product_id');
	}

    protected static function newFactory()
    {
        return \Modules\Shop\Database\factories\ShopFactory::new();
    }
}
