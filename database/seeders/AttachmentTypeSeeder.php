<?php

namespace Database\Seeders;

use App\Models\AttachmentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttachmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        AttachmentType::truncate();

        $data = [
            1 => ['Remittance'],
            2 => ['Official Receipt'],
            3 => ['Others'],
        ];

        foreach($data as $index=>[$name]){
                AttachmentType::create([
                    'hash' => encrypt($index),
                    'name' => $name,
                ]);
        }
    }
}
