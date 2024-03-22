<?php

namespace Database\Seeders;

use App\Models\Recipient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recipient::truncate();

        for($x = 1 ; $x <= 10 ; $x++){
            Recipient::create([
                'hash' => encrypt($x),
                'name' => fake()->name,
                'position' => fake()->randomElement(["General Manager","CEO","President","Manager"]),
                'department' => fake()->randomElement(["Crewing Department","Manning Department","Shipping Department"]),
                'modified_by' => fake()->name,
            ]);
        }
    }
}
