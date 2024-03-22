<?php

namespace Database\Seeders;

use App\Models\Principal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrincipalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Principal::truncate();

        $data = [
            'NYK SHIPMANAGEMENT PTE LTD.',
            'HorizonHaul Maritime',
            'WaveCrest Cargo Lines',
            'SeaStar Logistics',
            'BlueSail Freight Services',
        ];

        foreach ($data as $index => $name) {
            Principal::create([
                'name' => $name,
                'modified_by' => 'John Doe',
                'hash' => encrypt($index + 1) // Increment index by 1 since array index starts from 0
            ]);
        }
    }
}
