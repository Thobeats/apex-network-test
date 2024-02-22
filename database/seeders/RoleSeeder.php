<?php

namespace Database\Seeders;

use App\Models\Role;
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
        if (Role::count() === 0) {
            Role::insert([
                ['roleName' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
                ['roleName' => 'User', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }
}
