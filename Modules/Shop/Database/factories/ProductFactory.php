<?php

namespace Modules\Shop\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;
use Modules\Shop\Entities\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Shop\Entities\Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = fake()->words(2, true);

        return [
            'shop_id' => fake()->numberBetween(1,10),
			'sku' => fake()->isbn10,
			'type' => Product::SIMPLE,
			'name' => $name,
			'slug' => Str::slug($name),
			'price' => fake()->numberBetween(9000,9000000),
			'status' => Product::ACTIVE,
            'publish_date' => now(),
            'excerpt' => fake()->text(),
            'body' => fake()->text(),
            'weight' => fake()->numberBetween(1,10),
        ];
    }
}

