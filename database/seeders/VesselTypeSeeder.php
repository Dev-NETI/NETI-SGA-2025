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
            "1" => ["TANKER - LNG VESSELS"],
            "2" => ["TANKER - LPG VESSELS"],
            "3" => ["GAZ OCEAN VESSELS (LNG CARRIER)"],
            "4" => ["TANKER VESSELS"],
            "5" => ["CONTAINER VESSELS"],
            "6" => ["PCC VESSELS"],
            "7" => ["BULK VESSELS"],
            "8" => ["LNG BUNKER VESSELS"],
        ];

        foreach($data as $index=>[$name]){
            Vessel_type::create([
                'name' => $name,
                'hash' => encrypt($name)
            ]);
        }
    }
}
