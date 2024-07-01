<?php

namespace Modules\Shop\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Modules\Shop\Entities\Attribute;
use Modules\Shop\Entities\Category;
use Modules\Shop\Entities\Shop;
use Modules\Shop\Entities\Tag;
use Modules\Shop\Entities\Product;
use Modules\Shop\Entities\ProductAttribute;
use Modules\Shop\Entities\ProductImage;
use Modules\Shop\Entities\ProductInventory;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        User::factory(5)->create();

        $user = User::all();

        Attribute::setDefaultAttributes();
        $this->command->info('Default attributes seeded.');
        $attributeWeight = Attribute::where('code', Attribute::ATTR_WEIGHT)->first();

        Category::factory()->count(10)->create();
        $this->command->info('Categories seeded.');
        $randomCategoryIDs = Category::all()->random()->limit(2)->pluck('id');

        Tag::factory()->count(10)->create();
        $this->command->info('Tags seeded.');
        $randomTagIDs = Tag::all()->random()->limit(2)->pluck('id');

        for ($i = 1; $i <= 5; $i++) {
            Shop::factory()->create([
                'owner_id' => $user[$i - 1]->id
            ]);
        }

        $shop = Shop::all();

        for ($i = 1; $i <= 10; $i++) {
            $manageStock = true;

            $product = Product::factory()->create([
                'user_id' => $user[($i)%5 + 1]->id,
                'shop_id' => $shop[($i)%5 + 1]->id,
                'manage_stock' => $manageStock,
            ]);

            $product->categories()->sync($randomCategoryIDs);
            $product->tags()->sync($randomTagIDs);

            ProductAttribute::create([
                'product_id' => $product->id,
                'attribute_id' => $attributeWeight->id,
                'integer_value' => random_int(200, 2000), // gram
            ]);

            if ($manageStock) {
                ProductInventory::create([
                    'product_id' => $product->id,
                    'qty' => random_int(3, 20),
                    'low_stock_threshold' => random_int(1,3),
                ]);
            }
        }

            $images = [
                'sepatu1.jpg',
                'kipas1.jpg',
                'laptop.jpg',
                'joran.jpg',
                'gitar.jpg',
                'motor.jpg',
                'helmputih.jpg',
                'helmhitam.jpg',
                'sepatufaza.jpg',
                'sepaturizki.jpg',
                'motormerah.jpg',
                'p1.jpg',
                'p2.jpg',
                'p3.jpg',
                // 'p4.jpg',
            ];
            
            // Dapatkan semua produk dari database
            $products = Product::all();
            $productCount = $products->count();
            $imageCount = count($images);
            
            if ($productCount >= $imageCount) {
                // Campurkan gambar
                shuffle($images);
            
                // Variabel untuk melacak gambar yang telah digunakan
                $usedImages = [];
                $imageIndex = 0;
            
                foreach ($products as $product) {
                    // Periksa apakah kita masih memiliki gambar untuk dipetakan
                    if ($imageIndex < $imageCount) {
                        $image = $images[$imageIndex];
                        $imageIndex++;
                        
                        // Simpan gambar yang dipilih ke database
                        if (!ProductImage::where('image', $image)->exists()) {
                            ProductImage::create([
                                'product_id' => $product->id,
                                'image' => $image,
                            ]);
                            $usedImages[] = $image; // Catat gambar yang digunakan
                        }
                    }
                }
            }
        

        $this->command->info('10 sample products seeded.');
}

}