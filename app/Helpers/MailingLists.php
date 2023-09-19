<?php
namespace App\Helpers;

use App\Models\User;

//
class MailingLists
{

    public static function addEmailsToCc($eventPayload)
    {
        $cc_emails = User::where(function ($query) use ($eventPayload) {
                //get only active users
                $query->where('status', '!=', 'Inactive')
                    ->where(function ($query){
                        //Add User with store Manager role (checker)
                        $query->orWhere('role', "ENGINEER");
                        // //Add Everyone in finance department
                        //     ->orWhere('role', 30)
                        // //Add Everyone in facilities department
                        //     ->orWhere('department_id', 34);
                    });
            })
            ->pluck('email');

        return $cc_emails;
    }

}
