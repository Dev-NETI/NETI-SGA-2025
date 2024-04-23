<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();

        $data = [
            "1" => [
                'System', 'SGA', 'NETI', 'noc@neti.com.ph', now(), Hash::make('password'), null,
                null, Str::random(10), null, null,
            ],
            "2" => [
                'Dabucol', 'J', 'V', 'DabucolJ.V@neti.com.ph', now(), Hash::make('password'), null,
                null, Str::random(10), null, null,
            ],
            "3" => [
                'Macalino', 'B', 'R', 'MacalinoB.R@neti.com.ph', now(), Hash::make('password'), null,
                null, Str::random(10), null, null,
            ],
            "4" => [
                'Monis', 'M', 'A', 'MonisMA@neti.com.ph', now(), Hash::make('password'), null,
                null, Str::random(10), null, null,
            ],
        ];

        foreach ($data as $index => [
            $lName, $mName, $fName, $email, $emailVerified, $password, $twoFaSecret, $twoFaRecovery,
            $rememberToken, $profilePath, $currentTeam
        ]) {

            User::create([
            'l_name' => $lName,
            'm_name' => $mName,
            'f_name' => $fName,
            'hash' => encrypt($index),
            'email' => $email,
            'email_verified_at' => $emailVerified,
            'password' => $password,
            'two_factor_secret' => $twoFaSecret,
            'two_factor_recovery_codes' => $twoFaRecovery,
            'remember_token' => $rememberToken,
            'profile_photo_path' => $profilePath,
            'current_team_id' => $currentTeam,
            ]);

        }
    }
}
