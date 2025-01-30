<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        // Retrieve menu IDs
        $master_data_menu_id = Menu::where('name', 'Master Data')->value('id');
        $workspace_menu_id = Menu::where('name', 'Workspace')->value('id');

        // Insert menu items
        $list_menu_itemm = [
            // MASTER DATA
            [
                'id' => Str::uuid(),
                'name' => 'Agenda',
                'icon' => 'ri-calendar-schedule-fill',
                'route' => 'agenda.index',
                'permission_name' => 'agenda_index',
                'menu_id' => $master_data_menu_id,
                'index' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Masjid',
                'icon' => 'ri-building-fill',
                'route' => 'masjid.index',
                'permission_name' => 'masjid_index',
                'menu_id' => $master_data_menu_id,
                'index' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Ustadz',
                'icon' => 'ri-map-pin-user-fill',
                'route' => 'ustadz.index',
                'permission_name' => 'ustadz_index',
                'menu_id' => $master_data_menu_id,
                'index' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // WORKSPACE
            [
                'id' => Str::uuid(),
                'name' => 'Takjil',
                'icon' => 'ri-cake-3-fill',
                'route' => 'takjil.index',
                'permission_name' => 'takjil_index',
                'menu_id' => $workspace_menu_id,
                'index' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Imam dan Pembicara',
                'icon' => 'ri-speak-fill',
                'route' => 'kultum.index',
                'permission_name' => 'kultum_index',
                'menu_id' => $workspace_menu_id,
                'index' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Export PDF',
                'icon' => 'ri-file-pdf-2-fill',
                'route' => 'exportpdf.index',
                'permission_name' => 'exportpdf_index',
                'menu_id' => $workspace_menu_id,
                'index' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        // Bulk insert
        MenuItem::insert($list_menu_itemm);
    }
}
