<?php

namespace Tests\Unit;

use App\Entities\Image;
use App\Entities\Post;
use Tests\GetsTestData;
use Tests\TestCase;

class PostTest extends TestCase
{
    use GetsTestData;

    /** @test */
    function it_can_hydrate_an_instance_from_data()
    {
        $post = new Post;
        $post->hydrate($this->getPostDataFromTestJson());

        $this->assertEquals(1, $post->getId());
    }

    /** @test */
    function can_get_featured_image()
    {
        $post = new Post;
        $post->hydrate($this->getPostDataFromTestJson());

        $image = $post->getFeaturedImage();

        $this->assertTrue(is_a($image, Image::class));
    }

    private function getPostDataFromTestJson()
    {
        return $this->getTestData()[0];
    }
}