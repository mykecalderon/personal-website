<?php

namespace Tests\Unit;

use App\Entities\Post;
use Tests\TestCase;

class PostTest extends TestCase
{
    /** @test */
    function it_can_hydrate_an_instance_from_data()
    {
        $post = new Post;
        $post->hydrate($this->getTestData()[0]);

        $this->assertEquals(1, $post->getId());
    }

    private function getTestData()
    {
        $file = 'tests/wp_api_test_data.json';
        $data = file_get_contents(base_path($file));

        return json_decode($data);
    }
}