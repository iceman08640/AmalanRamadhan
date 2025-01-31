<?php

namespace Database\Seeders;

use App\Models\Route;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $list_route = [
            // DASHBOARD
            [
                'id' => Str::uuid(),
                'name' => 'dashboard.index',
                'permission_name' => 'dashboard_index',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // agenda
            [
                'id' => Str::uuid(),
                'name' => 'agenda.index',
                'permission_name' => 'agenda_index',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'agenda.create',
                'permission_name' => 'agenda_create',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'agenda.show',
                'permission_name' => 'agenda_show',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'agenda.update',
                'permission_name' => 'agenda_update',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'agenda.store',
                'permission_name' => 'agenda_store',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'agenda.destroy',
                'permission_name' => 'agenda_destroy',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'agenda.create.quick.mode',
                'permission_name' => 'agenda_create_quick_mode',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'agenda.store.quick.mode',
                'permission_name' => 'agenda_store_quick_mode',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // masjid
            [
                'id' => Str::uuid(),
                'name' => 'masjid.index',
                'permission_name' => 'masjid_index',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'masjid.create',
                'permission_name' => 'masjid_create',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'masjid.show',
                'permission_name' => 'masjid_show',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'masjid.update',
                'permission_name' => 'masjid_update',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'masjid.store',
                'permission_name' => 'masjid_store',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'masjid.destroy',
                'permission_name' => 'masjid_destroy',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // catatan_surat
            [
                'id' => Str::uuid(),
                'name' => 'catatan_surat.index',
                'permission_name' => 'catatan_surat_index',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'catatan_surat.create',
                'permission_name' => 'catatan_surat_create',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'catatan_surat.show',
                'permission_name' => 'catatan_surat_show',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'catatan_surat.update',
                'permission_name' => 'catatan_surat_update',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'catatan_surat.store',
                'permission_name' => 'catatan_surat_store',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'catatan_surat.destroy',
                'permission_name' => 'catatan_surat_destroy',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ttd
            [
                'id' => Str::uuid(),
                'name' => 'ttd.index',
                'permission_name' => 'ttd_index',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'ttd.create',
                'permission_name' => 'ttd_create',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'ttd.show',
                'permission_name' => 'ttd_show',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'ttd.update',
                'permission_name' => 'ttd_update',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'ttd.store',
                'permission_name' => 'ttd_store',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'ttd.destroy',
                'permission_name' => 'ttd_destroy',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // cap
            [
                'id' => Str::uuid(),
                'name' => 'cap.index',
                'permission_name' => 'cap_index',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'cap.create',
                'permission_name' => 'cap_create',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'cap.show',
                'permission_name' => 'cap_show',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'cap.update',
                'permission_name' => 'cap_update',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'cap.store',
                'permission_name' => 'cap_store',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'cap.destroy',
                'permission_name' => 'cap_destroy',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ustadz
            [
                'id' => Str::uuid(),
                'name' => 'ustadz.index',
                'permission_name' => 'ustadz_index',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'ustadz.create',
                'permission_name' => 'ustadz_create',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'ustadz.show',
                'permission_name' => 'ustadz_show',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'ustadz.update',
                'permission_name' => 'ustadz_update',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'ustadz.store',
                'permission_name' => 'ustadz_store',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'ustadz.destroy',
                'permission_name' => 'ustadz_destroy',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // takjil
            [
                'id' => Str::uuid(),
                'name' => 'takjil.index',
                'permission_name' => 'takjil_index',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'takjil.create',
                'permission_name' => 'takjil_create',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'takjil.show',
                'permission_name' => 'takjil_show',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'takjil.update',
                'permission_name' => 'takjil_update',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'takjil.store',
                'permission_name' => 'takjil_store',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'takjil.destroy',
                'permission_name' => 'takjil_destroy',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // kultum
            [
                'id' => Str::uuid(),
                'name' => 'kultum.index',
                'permission_name' => 'kultum_index',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'kultum.create',
                'permission_name' => 'kultum_create',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'kultum.show',
                'permission_name' => 'kultum_show',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'kultum.update',
                'permission_name' => 'kultum_update',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'kultum.store',
                'permission_name' => 'kultum_store',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'kultum.destroy',
                'permission_name' => 'kultum_destroy',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // export pdf
            [
                'id' => Str::uuid(),
                'name' => 'exportpdf.index',
                'permission_name' => 'exportpdf_index',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'exportpdf.download',
                'permission_name' => 'exportpdf_download',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'exportpdf.ustadz.download',
                'permission_name' => 'exportpdf_ustadz_download',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Bulk insert
        Route::insert($list_route);
    }
}
