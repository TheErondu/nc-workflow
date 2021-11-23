<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'access-dir_reports',
           'access-dir_reports-readonly',
           'access-ob_logs',
           'access-ob_logs-readonly',
           'access-mcr_logs',
           'access-mcr_logs-readonly',
           'access-production_show_logs',
           'access-production_show_logs-readonly',
           'access-prompter_logs',
           'access-prompter_logs-readonly',
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
