<?php

namespace App\Contracts;

use App\Contracts\Hydratable;

interface CreatableFromApiData extends Hydratable
{
    /**
     * @param $data
     */
    public static function createFromData($data);
}