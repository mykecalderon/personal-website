<?php

namespace Tests;

trait GetsTestData
{
    private function getTestData()
    {
        $file = 'tests/wp_api_test_data.json';
        $data = file_get_contents(base_path($file));

        return json_decode($data);
    }
}