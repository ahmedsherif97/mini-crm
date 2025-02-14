<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Modules\Setting\App\Models\Setting;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->seedPermissions();

        $list = [
            [
                'id' => 1,
                'slug' => 'name',
                'type' => 'text',
                'value' => 'CRM'
            ],
            [
                'id' => 2,
                'slug' => 'logo',
                'type' => 'image',
                'value' => '/assets/img/logo.png'
            ],
            [
                'id' => 3,
                'slug' => 'favicon',
                'type' => 'image',
                'value' => '/assets/favicon/favicon.png'
            ],
            [
                'id' => 4,
                'slug' => 'primary-color',
                'type' => 'color',
                'value' => '#0eb7a2'
            ],
            [
                'id' => 5,
                'slug' => 'secondary-color',
                'type' => 'color',
                'value' => '#959595'
            ],
            [
                'id' => 6,
                'slug' => 'currency',
                'type' => 'currency',
                'value' => 'ريال سعودي'
            ],
            [
                'id' => 7,
                'slug' => 'currency-symbol',
                'type' => 'currency',
                'value' => 'SR'
            ],

            [
                'id' => 8,
                'slug' => 'header-height',
                'type' => 'header-height',
                'value' => '0'
            ],
            [
                'id' => 9,
                'slug' => 'footer-height',
                'type' => 'footer-height',
                'value' => '120'
            ],
            [
                'id' => 13,
                'slug' => 'site-address',
                'type' => 'text',
                'value' => 'الرياض - المملكة العربية السعودية'
            ],
        ];
        Setting::upsert(
            $list,
            $except = ['id', 'slug'],
            getArrayKeys($list[0], $except)
        );
    }

    protected function seedPermissions()
    {
        $moduleName = Str::snake('Setting');

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
