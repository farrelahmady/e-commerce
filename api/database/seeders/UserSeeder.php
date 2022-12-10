<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\ManagementAccess\User;
use Laravolt\Indonesia\Models\Village;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    protected $totalUser = 10;
    protected $array = [
        [
            'email'    => 'superadmin@gmail.com',
            'password' => "superadmin@123",
            "role"     => [1, 2]
        ],
        [
            'email'    => 'admin@gmail.com',
            'password' => "admin@123",
            "role"     => [2]
        ],
        [
            'email'    => 'seller@gmail.com',
            'password' => 'password',
            "role"     => [3, 4]
        ],
        [
            'email'    => 'customer@gmail.com',
            'password' => 'password',
            "role"     => [4]
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = fake("id_ID");

        for ($i = 0; $i < $this->totalUser; $i++) {
            $indo = Village::all()->random();
            if ($i < count($this->array)) {
                $account = $this->array[$i];
                $user = User::create([
                    'email'    => $account['email'],
                    'password' => bcrypt($account['password']),
                ]);
                foreach ($account['role'] as $role) {
                    $user->assignRole($role);
                }
            } else {
                $user = User::create([
                    'email' => preg_replace('/@example\..*/', '@gmail.com', $faker->unique()->safeEmail),
                    'password' => bcrypt('password'),
                ]);

                $faker->boolean() ? $user->assignRole(3) : "";
                $user->assignRole(4);
            }

            $userDetail = [
                'first_name'  => $faker->firstName,
                'last_name'   => $faker->lastName,
                "birthdate"   => $faker->date('Y-m-d'),
                "gender"      => $faker->numberBetween(1, 2),
                "address"     => "Jalan " . $faker->streetName(),
                "province"    => $indo->provinceName,
                "city"        => $indo->cityName,
                "district"    => $indo->districtName,
                "village"     => $indo->name,
                "postal_code" => $indo->pos,
                "contact"     => $faker->phoneNumber,
            ];

            // $getImage = Http::get("https://source.unsplash.com/640x480?people")->body();
            // $imageName = $userDetail['first_name'] . '-' . $userDetail['last_name'] . '.jpg';
            // Storage::disk('public')->put("user/$imageName", $getImage);

            // $userDetail["profile"] = asset("storage/user/$imageName");

            $userDetail["profile"] = "https://via.placeholder.com/150/" . ltrim($faker->hexColor(), "#") . "?text=" . str_replace(" ", "+", $userDetail['first_name'] . " " . $userDetail['last_name']);

            $user->detail()->create($userDetail);
        }
    }
}
