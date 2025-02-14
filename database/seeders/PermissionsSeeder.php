<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::query()->firstOrCreate(
            ['name' => 'employee'],
            ['guard_name' => 'web']
        );

        Permission::query()->updateOrCreate(
            ['name' => 'access dashboard'],
            ['guard_name' => 'web']
        );

        $modelNames = ['employee', 'customer'];

        foreach ($modelNames as $model) {
            $permissions = ['list', 'show', 'create', 'update', 'delete'];

            if ($model === 'customer') {
                $permissions[] = 'reassign';
            }

            $permissionsList = array_map(function ($permission) use ($model) {
                return [
                    'name' => "$permission $model",
                    'guard_name' => 'web'
                ];
            }, $permissions);

            Permission::query()->upsert($permissionsList, ['name'], ['guard_name']);

            if ($model === 'customer') {
                $role->givePermissionTo(array_column($permissionsList, 'name'));
            }
        }

        $role->givePermissionTo('access dashboard');
    }
}
