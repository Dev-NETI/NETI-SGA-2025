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
            '2' => ['Letter View (SGA Module)'],
            '3' => ['Training Fee View (SGA Module)'],
            '4' => ['Generate Letter (SGA Module)'],
            '5' => ['Generate Training Fee (SGA Module)'],
            '6' => ['Vessel Management'],
            '7' => ['Vessel View (Vessel Management)'],
            '8' => ['Create Vessel (Vessel Management)'],
            '9' => ['Edit Vessel (Vessel Management)'],
            '10' => ['Delete Vessel (Vessel Management)'],
            '11' => ['Vessel Type View (Vessel Management)'],
            '12' => ['Create Vessel Type (Vessel Management)'],
            '13' => ['Edit Vessel Type (Vessel Management)'],
            '14' => ['Delete Vessel Type (Vessel Management)'],
            '15' => ['Principal View (Vessel Management)'],
            '16' => ['Create Principal (Vessel Management)'],
            '17' => ['Edit Principal (Vessel Management)'],
            '18' => ['Delete Principal (Vessel Management)'],
            '19' => ['Recipient View (Vessel Management)'],
            '20' => ['Create Recipient (Vessel Management)'],
            '21' => ['Edit Recipient (Vessel Management)'],
            '22' => ['Delete Recipient (Vessel Management)'],
            '23' => ['User Management'],
            '24' => ['Users View (User Management)'],
            '25' => ['Create User (User Management)'],
            '26' => ['Edit User (User Management)'],
            '27' => ['Delete User (User Management)'],
            '28' => ['Assign Roles (User Management)'],
            '29' => ['Change Password (User Management)'],
            '30' => ['Company View (User Management)'],
            '31' => ['Create Company (User Management)'],
            '32' => ['Edit Company (User Management)'],
            '33' => ['Delete Company (User Management)'],
            '34' => ['Department View (User Management)'],
            '35' => ['Create Department (User Management)'],
            '36' => ['Edit Department (User Management)'],
            '37' => ['Delete Department (User Management)'],
            '38' => ['Logs (Log Module)'],
            '39' => ['Summary (Log Module)'],
            '40' => ['F-FC-007 (Log Module)'],
            '41' => ['Summary Report Dashboard'],//starting from here, hindi pa naimplement gates, do delete if ok na
            '42' => ['Summary Maintenance'],
            '43' => ['Generate Board(Summary Dashboard Module)'],
            '44' => ['Verification Board(Summary Dashboard Module)'],
            '45' => ['Approval Board(Summary Dashboard Module)'],
            '46' => ['Add Summary Email Recipient(Summary Dashboard Module)'],
            '47' => ['Delete Summary Email Recipient(Summary Dashboard Module)'],
        ];

        foreach($data as $index=>[$name]){
            Role::create([
                'name' => $name
            ]);
        }

    }
    
}
