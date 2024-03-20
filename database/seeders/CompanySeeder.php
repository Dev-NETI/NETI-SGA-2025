<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Company::truncate();
        $data = [
            '1' => ["NYK-Fil Maritime E-Training, Inc.","NETI"],
            '2' => ["NYK-Fil Ship Management, Inc.","NSMI"],
        ];

        foreach($data as $index=>[$name,$code]){
            Company::create([
                'name' => $name,
                'hash' => encrypt($index),
                'code' => $code,
                'modified_by' => ''
            ]);
        }
    }
}
