<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;

class SqlFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $path = public_path('sql/default.sql');
        $sql = file_get_contents($path);
        FacadesDB::unprepared($sql);
    }
}
