<?php

namespace App\Traits;

use Exception;

trait QueryTrait
{

    public function store($query, $errorMsg, $successMsg)
    {
        try {
            if (!$query) {
                session()->flash('error', $errorMsg);
            }
            session()->flash('success', $successMsg);

        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    // public function update($data,$routeBack,$query, $errorMsg, $successMsg, $route)
    // {
    //     if (!$data) {
    //         session()->flash('error', 'Data not found');
    //         return $this->redirectRoute($routeBack);
    //     }
    //     $this->store($query, $errorMsg, $successMsg, $route);
    // }
}
