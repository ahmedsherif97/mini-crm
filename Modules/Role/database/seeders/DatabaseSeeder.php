<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Role\App\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->seedPermissions();
        Role::query()->firstOrCreate([
            'name' => 'Employee',
            'guard_name' => 'web'
        ]);
    }

    protected function seedPermissions()
    {
        $moduleName = Str::snake('Role');

        $permissions = ['list', 'show', 'create', 'update', 'delete'];
        $list = [];
        foreach ($permissions as $key => $value) {
            $list[] = [
                'name' => "$value $moduleName",
                'guard_name' => 'web'
            ];
        }
        Permission::upsert(
            $list,
            $except = [],
            getArrayKeys($list[0], $except)
        );
    }
}
