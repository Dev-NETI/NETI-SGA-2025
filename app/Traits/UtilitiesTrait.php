<?php

namespace App\Traits;

use Illuminate\Support\Str;


trait UtilitiesTrait
{

    public function generateReferenceNumber()
    {
        $date = now()->format('YmdHis');
        $random = mt_rand(1000000000, 9999999999);

        return $date . '-' . $random;
    }

    public function generateVerificationPin($length)
    {
        $verificationPin = mt_rand(100000, $length);
        return $verificationPin;
    }

}
