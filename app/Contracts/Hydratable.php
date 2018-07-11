<?php

namespace App\Contracts;

interface Hydratable
{
    /**
     * @param $data
     */
    public function hydrate($data);
}