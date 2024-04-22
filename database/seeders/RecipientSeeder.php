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

        Recipient::create([
            'hash' => encrypt(1),
            'name' => 'CE Deepak Arora',
            'position' => 'General Manager',
            'department' => 'Crewing Department',
            'modified_by' => 'System',
        ]);
    }
}
