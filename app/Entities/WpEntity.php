<?php

namespace App\Entities;

use App\Contracts\CreatableFromApiData;

abstract class WpEntity implements CreatableFromApiData
{
    public static function createFromData($data)
    {
        return (new static)->hydrate($data);
    }

    public abstract function hydrate($data);
}