<?php

namespace Modules\Shop\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\UuidTrait;

class ProductImage extends Model
{
    use HasFactory, UuidTrait;

    protected $table = 'shop_product_images';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'image',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Shop\Database\factories\ProductImageFactory::new();
    }
}
