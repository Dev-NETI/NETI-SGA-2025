<?php

namespace Database\Seeders;

use App\Models\Vessel_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VesselTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vessel_type::truncate();

        $data = [
            "1" => ["TANKER - LNG"],
            "2" => ["TANKER - LPG"],
            "3" => ["GAZ OCEAN - LNG"],
            "4" => ["TANKER"],
            "5" => ["CONTAINER"],
            "6" => ["PCC"],
            "7" => ["BULKER"],
            "8" => ["BUNKER LNG"],
        ];

        foreach ($data as $index => [$name]) {
            Vessel_type::create([
                'name' => $name,
                'hash' => encrypt($name)
            ]);
        }
    }
}
