<?php
namespace App\Service;

use App\Jobs\Designation\FetchDesignation;
use App\Models\Designation;

class DesignationService
{

    public function createNewDesignation()
    {
        try {
            $designation = dispatch(new FetchDesignation());

            $designation = new Designation();
            $designation->name = $designation['name'];
            $designation->save();
            return $designation;
        } catch (\Exception $e) {
            throw new \ErrorException($e->getMessage());
        }
    }

}
