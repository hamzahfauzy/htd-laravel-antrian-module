<?php

namespace App\Modules\Antrian\Libraries;

use App\Modules\Antrian\Models\OrganizationUser;

class Utility {

    static function getUserOrganization($user)
    {
        return OrganizationUser::where('user_id', $user->id)->first();
    }
}