<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserRole::truncate();

        $data = [
            '1' => [1,1],
            '2' => [2,1],
            '3' => [3,1],
            '4' => [4,1],
            '5' => [5,1],
            '6' => [6,1],
            '7' => [7,1],
            '8' => [8,1],
        ];

        foreach($data as $index=>[$role_id,$user_id]){
            UserRole::create([
                'role_id' => $role_id,
                'user_id' => $user_id
            ]);
        }
        
    }
}
