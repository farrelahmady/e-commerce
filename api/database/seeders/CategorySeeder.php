<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterData\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    protected $categories = [
        "AKSESORIS" => [
            "GELANG",
            "KALUNG",
            "CINCIN",
            "ANTING",
        ],
        "AKSESORIS KEPALA" => [
            "TOPI",
            "KUPLUK",
            "KERUDUNG",
        ],
        "ALAS KAKI" => [
            "SEPATU",
            "SANDAL",
            "SNEAKER",
            "BOOT",
            "KAOS KAKI",
        ],
        "ATASAN" => [
            "KAOS",
            "KEMEJA",
            "JAKET",
            "JAS",
        ],
        "BAWAHAN" => [
            "CELANA",
            "ROK",
            "JOGGER",
            "JEANS",
            "BOXER",
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category => $subCategories) {
            $category = Category::create([
                'name' => $category,
            ]);

            foreach ($subCategories as $subCategory) {
                $category->productCategory()->create([
                    'name' => $subCategory,
                ]);
            }
        }
    }
}
