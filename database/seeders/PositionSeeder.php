<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::truncate();
        $data = [
            1 => ["System Administrator"],
            2 => ["Comptroller"],
            3 => ["Accountant"],
            4 => ["Employee"],
            5 => ["General Manager"]
        ];

        foreach($data as $index=>[$name]){
            Position::create([
                'name' => $name,
                'modified_by' => 'John Doe'
            ]);
        }

    }
}
