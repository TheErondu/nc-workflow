<?php

namespace App\Utils;

use Illuminate\Support\Facades\DB;

class Globals
{
    static function mailingGroups($dept)
    {
        switch ($dept) {
            case "Engineers":
                //  return  \App\Models\User::where('department_id', '11')->pluck('email');
                return DB::select('SELECT email from users WHERE department_id = 11 AND status = "active"');
        }
    }
    static function site_url(){
        
    }
}
