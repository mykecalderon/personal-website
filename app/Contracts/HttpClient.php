<?php

namespace App\Contracts;

interface HttpClient
{
    /**
     * @param $url
     * @param $args array of query params
     */
    public function get($url, array $args = []);
}