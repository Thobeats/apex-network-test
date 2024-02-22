<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Define roles data
       $roles = [
            ['roleName' => 'Admin'],
            ['roleName' => 'User'],
            // Add more roles as needed
        ];

        // Insert roles into the database
        foreach ($roles as $role) {
            $role['created_at'] = Carbon::now();
            $role['updated_at'] = Carbon::now();
            DB::table('roles')->insert($role);
        }
    }
}
