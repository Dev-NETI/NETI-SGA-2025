<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::truncate();

        $data = [
            '1' => ['View Vessel'],
            '2' => ['Create Vessel'],
            '3' => ['Edit Vessel'],
            '4' => ['Delete Vessel'],
            '5' => ['View Vessel Type'],
            '6' => ['Create Vessel Type'],
            '7' => ['Edit Vessel Type'],
            '8' => ['View Vessel Type']
        ];

        foreach($data as $index=>[$name]){
            Role::create([
                'name' => $name
            ]);
        }
    }
}
