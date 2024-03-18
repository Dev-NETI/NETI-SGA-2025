<?php

namespace Database\Seeders;

use App\Models\Vessel;
use App\Models\Vessel_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VesselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vessel::truncate();

        for($x = 1 ; $x < 11 ; $x++){
            Vessel::create([
                'vessel_type_id' => Vessel_type::inRandomOrder()->pluck('id')->first(),
                'hash' => encrypt($x),
                'name' => fake()->name(),
                'code' => fake()->lexify('????'),
                'training_fee' => rand(1, 2000),
                'is_active' => 1,
                'modified_by' => 'MJ Valdez',
            ]);
        }
    }
}
