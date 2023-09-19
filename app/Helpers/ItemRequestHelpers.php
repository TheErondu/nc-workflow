<?php
namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ItemRequestHelpers
{
    public static function departmentIsSameAsRequestor(User $requestor): bool
    {
        $user = Auth::user();

        if ($user->department->id == $requestor->department->id) {
            return true;
        } else {
            return false;
        }

    }
}
