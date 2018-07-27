<?php

namespace Tests\Unit;

use App\Entities\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\GetsTestData;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use GetsTestData;

    /** @test */
    function it_can_hydrate_an_instance_from_data()
    {
        $category = new Category;
        $category->hydrate($this->getCategoryDataFromTestJson());

        $this->assertEquals(1, $category->getId());
        $this->assertEquals('Uncategorized', $category->getName());
        $this->assertEquals('uncategorized', $category->getSlug());
    }

    private function getCategoryDataFromTestJson()
    {
        $data =$this->getTestData()[0]->_embedded->{"wp:term"};
        return collect($data)->collapse()->where('taxonomy', 'category')->first();
    }
}