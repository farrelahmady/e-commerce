<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\ManagementAccess\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sellers = User::with("detail")->whereHas('role', function ($query) {
            $query->where('role_id', 3);
        })->get();

        $faker = fake("id_ID");

        foreach ($sellers as $seller) {
            $store = [
                'name'        => $seller->detail->first_name . "  STORE",
                'description' => $faker->sentence(10),
                'logo'        => "https://via.placeholder.com/150/" . ltrim($faker->hexColor(), "#") . "?text=" . str_replace(" ", "+", $seller->detail->name),
                'address'     => $seller->detail->address,
                "province"    => $seller->detail->province,
                "city"        => $seller->detail->city,
                "district"    => $seller->detail->district,
                "village"     => $seller->detail->village,
                "postal_code" => $seller->detail->postal_code,
                "contact"     => $seller->detail->contact,
            ];

            $seller->store()->create($store);
        }
    }
}
