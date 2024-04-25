<?php

namespace App;

trait DashboardTrait
{
    public function count($query)
    {
        if (!count($query) > 0) {
            return 0;
        }
        return $query->count();
    }
}
