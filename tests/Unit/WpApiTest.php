<?php

namespace Tests\Unit;

use App\Services\HttpClient;
use App\Services\WpApi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WpApiTest extends TestCase
{
    /** @test */
    function it_can_retrieve_a_post_by_id()
    {
        $wp = new WpApi(env('WP_API_URL'), new HttpClient());
        $post = $wp->posts(['slug' => 'my-test-post'])->first();

        $this->assertEquals('My Test Post', $post->getTitle());
        $this->assertEquals('my-test-post', $post->getSlug());
        $this->assertEquals('publish', $post->getStatus());
    }
}