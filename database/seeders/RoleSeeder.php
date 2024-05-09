<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();

        $data = [
            '1' => ['SGA Module'],
            '2' => ['Generate Letter (SGA Module)'],
            '3' => ['Generate Training Fee (SGA Module)'],
            
            '4' => ['Vessel Management'],
            '5' => ['Vessel View (Vessel Management)'],
            '6' => ['Create Vessel (Vessel Management)'],
            '7' => ['Edit Vessel (Vessel Management)'],
            '8' => ['Delete Vessel (Vessel Management)'],
            '9' => ['Vessel Type View (Vessel Management)'],
            '10' => ['Create Vessel Type (Vessel Management)'],
            '11' => ['Edit Vessel Type (Vessel Management)'],
            '12' => ['Delete Vessel Type (Vessel Management)'],
            
            '13' => ['User Management'],
            '14' => ['Users View (User Management)'],
            '15' => ['Create User (User Management)'],
            '16' => ['Edit User (User Management)'],
            '17' => ['Delete User (User Management)'],
            '18' => ['Assign Roles (User Management)'],
            '19' => ['Change Password (User Management)'],
            '20' => ['Company View (User Management)'],
            '21' => ['Create Company (User Management)'],
            '22' => ['Edit Company (User Management)'],
            '23' => ['Delete Company (User Management)'],
            '24' => ['Department View (User Management)'],
            '25' => ['Create Department (User Management)'],
            '26' => ['Edit Department (User Management)'],
            '27' => ['Delete Department (User Management)'],
            
            '28' => ['Summary Report Dashboard'],//starting from here, hindi pa naimplement gates, do delete if ok na
            '29' => ['Summary Maintenance'],
            '30' => ['Add Summary Email Recipient(Summary Dashboard Module)'],
            '31' => ['Delete Summary Email Recipient(Summary Dashboard Module)'],
            '32' => ['Generate Board(Summary Dashboard Module)'],
            '33' => ['Verification Board(Summary Dashboard Module)'],
            '34' => ['Approval Board(Summary Dashboard Module)'],
            '35' => ['Principal Board(Summary Dashboard Module)'],
            '36' => ['Close Board(Summary Dashboard Module)'],

            '37' => ['Training Fee Report Dashboard'],//starting from here, hindi pa naimplement gates, do delete if ok na
            '38' => ['Training Fee Maintenance'],
            '39' => ['Add Training Fee Email Recipient(Training Fee Dashboard Module)'],
            '40' => ['Delete Training Fee Email Recipient(Training Fee Dashboard Module)'],
            '41' => ['Generate Board(Training Fee Dashboard Module)'],
            '42' => ['Verification Board(Training Fee Dashboard Module)'],
            '43' => ['Approval Board(Training Fee Dashboard Module)'],
            '44' => ['Principal Board(Training Fee Dashboard Module)'],
            '45' => ['O.R. Board(Training Fee Dashboard Module)'],
            '46' => ['Close Board(Training Fee Dashboard Module)'],
            
        ];

        foreach($data as $index=>[$name]){
            Role::create([
                'name' => $name
            ]);
        }

    }
    
}
