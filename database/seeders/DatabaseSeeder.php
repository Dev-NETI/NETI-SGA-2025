<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            UserRoleSeeder::class,
            VesselTypeSeeder::class,
            VesselSeeder::class,
            CompanySeeder::class,
            DepartmentSeeder::class,
            PrincipalSeeder::class
        ]);
    }
}
