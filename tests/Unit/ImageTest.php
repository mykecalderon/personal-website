<?php

namespace Tests\Unit;

use App\Entities\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\GetsTestData;
use Tests\TestCase;

class ImageTest extends TestCase
{
    use GetsTestData;

    /** @test */
    function it_can_hydrate_an_instance_from_data()
    {
        $image = new Image;
        $image->hydrate($this->getImageDataFromTestJson());

        $this->assertEquals(7, $image->getId());
        $this->assertEquals('http://wp.me.test/wp-content/uploads/2018/03/IMG_0035.jpg', $image->getLink());
        $this->assertNotNull($image->getThumbnailUrl());
    }

    /** @test */
    function can_get_thumbnail_url()
    {
        $image = new Image;
        $image->hydrate($this->getImageDataFromTestJson());

        $this->assertEquals('http://wp.me.test/wp-content/uploads/2018/03/IMG_0035-150x150.jpg', $image->getThumbnailUrl());
    }

    private function getImageDataFromTestJson()
    {
        return $this->getTestData()[0]->_embedded->{'wp:featuredmedia'}[0];
    }
}