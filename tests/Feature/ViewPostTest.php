<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewPostTest extends TestCase
{
    /** @test */
    function can_view_a_post()
    {
        $response = $this->get('/blog/my-test-post');

        $response->assertStatus(200);
        $response->assertSee('My Test Post');
        $response->assertSee('This is a test post. Here is some content.');
    }
}
