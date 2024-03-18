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
            "1" => ["PCC"],
            "2" => ["LNG"],
            "3" => ["Tanker"],
            "4" => ["Container"],
            "5" => ["Bulker"],
            "6" => ["LPG"],
            "7" => ["CTNR & LNG"],
            "8" => ["Container & PCC"],
            "9" => ["Tanker & Product Tanker"],
            "10" => ["Container & Tanker"],
            "11" => ["Product Tanker"],
            "12" => ["Camless Engine"],
            "13" => ["Coal Tar"],
            "14" => ["Woodchip Carrier"],
            "15" => ["VLCC"],
        ];

        foreach($data as $index=>[$name]){
            Vessel_type::create([
                'name' => $name,
                'hash' => encrypt($name)
            ]);
        }
    }
}
