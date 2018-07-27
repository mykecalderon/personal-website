<?php

namespace Tests\Unit;

use App\Entities\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\GetsTestData;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use GetsTestData;

    /** @test */
    function it_can_hydrate_an_instance_from_data()
    {
        $author = new Author;
        $author->hydrate($this->getAuthorDataFromTestJson());

        $this->assertEquals(1, $author->getId());
        $this->assertEquals('mykecalderon', $author->getName());
    }

    private function getAuthorDataFromTestJson()
    {
        return $this->getTestData()[0]->_embedded->author[0];
    }
}