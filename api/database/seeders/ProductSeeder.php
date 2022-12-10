<?php

namespace Database\Seeders;

use App\Models\MasterData\ProductCategory;
use App\Models\MasterData\Tag;
use App\Models\Operational\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = ProductCategory::all();
        $stores = Store::all();

        $faker = fake('id_ID');
        foreach ($stores as $store) {
            for ($i = 0; $i < $faker->numberBetween(1, 5); $i++) {
                $ctg = $category->random();
                $productData = [
                    'name' => $ctg->name . " " . $faker->word,
                    'status' => $faker->randomElement([1, 2]),
                    'stock' => $faker->numberBetween(1, 50),
                    'price' => $faker->numberBetween(1, 10) * 10000,
                    "description" => $faker->sentence(10),
                    "category_id" => $ctg->id,
                ];
                $product = $store->products()->create($productData);

                for ($i = 0; $i < $faker->numberBetween(1, 5); $i++) {
                    $image = $product->images()->create([
                        'url' => "https://via.placeholder.com/150/" . ltrim($faker->hexColor(), "#") . "?text=" . str_replace(" ", "+", $product->name),
                    ]);

                    if ($i == 0) {
                        $product->update([
                            'thumbnail' => $image->id
                        ]);
                    }
                }

                $productTags = explode(" ", $product->name);

                for ($i = 0; $i < 2; $i++) {
                    $product->tags()->firstOrCreate([
                        'name' => $productTags[$i]
                    ]);
                }
            }
        }
    }
}
