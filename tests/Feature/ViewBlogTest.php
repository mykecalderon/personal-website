<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewBlogTest extends TestCase
{
    /** @test */
    function can_view_blog()
    {
        $response = $this->get('/blog');

        $response->assertStatus(200);
        $response->assertSee('My Test Post');
        $response->assertSee('http://wp.me.test/wp-content/uploads/2018/03/IMG_0035-150x150.jpg');
    }
}
