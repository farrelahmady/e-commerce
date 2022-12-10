<?php

namespace Database\Seeders;

use App\Models\ManagementAccess\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{

    protected $access = [
        'create',
        'read',
        'update',
        'delete',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modelList = [];
        $path = app_path() . "/Models";
        $results = scandir($path);

        foreach ($results as $result) {
            if ($result === '.' or $result === '..') continue;

            $modelFiles = scandir($path . "/" . $result);

            foreach ($modelFiles as $filename) {
                if ($filename === '.' or $filename === '..') continue;

                $model = "App\\Models\\" . $result . "\\" . explode(".", $filename)[0];

                $model = new $model;

                $modelList[] = $model->getTable();
            }
        }


        foreach ($modelList as $model) {
            foreach ($this->access as $access) {
                Permission::create([
                    'name' => strtoupper($model . "_" . $access),
                ]);
            }
        }
    }
}
