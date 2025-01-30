<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $list_menu = [
            [
                'id' => Str::uuid(),
                'name' => 'Dashboard',
                'icon' => 'ri-dashboard-2-fill',
                'route' => 'dashboard.index',
                'permission_name' => 'dashboard_index',
                'index' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Master Data',
                'icon' => 'ri-settings-2-fill',
                'route' => null,
                'permission_name' => 'masterdata',
                'index' => 8,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Workspace',
                'icon' => 'ri-rocket-2-fill',
                'route' => null,
                'permission_name' => 'workspace',
                'index' => 9,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        // Bulk insert
        Menu::insert($list_menu);
    }
}
