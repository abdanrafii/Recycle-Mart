<?php

namespace Modules\Shop\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;
use Modules\Shop\Entities\Shop;

class ShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Shop\Entities\Shop::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $name = fake()->words(3, true);

        return [
            'id' => 1,
            'name' => $name,
            'slug' => Str::slug($name),
            'excerpt' => fake()->text(),
            'body' => fake()->text()
        ];
    }
}

