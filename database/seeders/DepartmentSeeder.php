<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::truncate();
        $data = [
            '1' => ["Finance Department",1],
            '2' => ["Finance Department",2],
        ];

        foreach($data as $index=>[$name,$company]){
            Department::create([
                'name' => $name,
                'company_id' =>  $company,
                'modified_by' => ''
            ]);
        }
    }
}
