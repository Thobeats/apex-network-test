<?php

namespace App\Trait;

use App\Models\Role;
use Illuminate\Support\Facades\Session;

trait TestRoles{


    public function randomRole()
    {
        // Get the roles
        $adminRole = Role::where('roleName', 'Admin')->first();
        $userRole = Role::where('roleName', 'User')->first();

        return rand($adminRole->id,$userRole->id);
    }

    public function getHeaders()
    {
        return Session::get('headers');
    }
}