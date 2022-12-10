<?php

namespace App\Console\Commands;

use Nette\Utils\Json;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\ManagementAccess\Role;
use App\Models\ManagementAccess\User;
use Illuminate\Support\Facades\Schema;
use Laravolt\Indonesia\Models\Village;
use Illuminate\Support\Facades\Storage;
use App\Models\ManagementAccess\Permission;
use Illuminate\Support\Facades\Http;

class Output extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'output';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'My Output Testing';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $permissions = Permission::all();

        // // Storage::put('test.json', $permissions->filter(
        // //     fn ($permission) =>
        // //     !in_array(explode("_", $permission->title)[0], ["USER", "ROLE", "PERMISSION"])
        // // )->toJson());

        // $modelList = [];
        // $path = app_path() . "/Models";
        // $results = scandir($path);

        // foreach ($results as $result) {
        //     if ($result === '.' or $result === '..') continue;

        //     $modelFiles = scandir($path . "/" . $result);

        //     foreach ($modelFiles as $filename) {
        //         if ($filename === '.' or $filename === '..') continue;

        //         $model = "App\\Models\\" . $result . "\\" . explode(".", $filename)[0];

        //         $model = new $model;

        //         $modelList[] = $model->getTable();
        //     }
        // }
        // Storage::put('output.json', json_encode($modelList));

        // Storage::put('output.json', $permissions->filter(
        //     fn ($permission) =>
        //     !in_array(explode("_", $permission->name)[0], ["USERS"])
        // )->toJson());

        // $roles              = Role::with('permission')->get();
        // $permissionsArray   = [];

        // // nested loop
        // // looping for role ( where table role )
        // foreach ($roles as $role) {
        //     // looping for permission ( where table permnission_role )
        //     foreach ($role->permission as $permissions) {
        //         $permissionsArray[$permissions->name][] = $role->id;
        //     }
        // }
        // $indo = Village::limit(20)->get()->random();


        // $seller = User::with('role')->whereHas('role', function ($query) {
        //     $query->where('role_id', 3);
        // })->get();

        $res = Http::get("https://source.unsplash.com/640x480?people");
        // var_dump(file_get_contents($res->body()));
        Storage::disk('public')->put('user/output.jpg', $res);
        // Storage::disk('public')->allDirectories();
        // Storage::delete("dummy/output.jpg");
        // Storage::put('output.jpg', $res);
    }
}
