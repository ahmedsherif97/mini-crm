<?php

namespace Modules\Activity\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->seedPermissions();
    }

    protected function seedPermissions()
    {
        $moduleName = Str::snake('Activity');

        $permissions = ['list', 'show', 'create', 'update', 'delete'];
        $list = [];
        foreach ($permissions as $key => $value) {
            $list[] = [
                'name' => "$value " . ($value == 'list' ? Str::plural($moduleName) : $moduleName),
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
