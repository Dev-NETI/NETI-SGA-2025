<?php

namespace Database\Seeders;

use App\Models\Process;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Process::truncate();

        $data = [
            'Generate Board',
            'Verification Board',
            'Comptroller Board',
            'President Board',
            'Close Board'
        ];

        foreach ($data as $index => $name) {
            Process::create([
                'name' => $name,
            ]);
        }
    }
}
