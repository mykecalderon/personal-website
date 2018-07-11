<?php

namespace App\Services;

use App\Entities\Post;

class WpApi
{
    protected $base_url;
    protected $client;

    /**
     * @param    $base_url   
     * @param    $client   
     */
    public function __construct($base_url, $client)
    {
        $this->base_url = $base_url;
        $this->client = $client;
    }

    protected function url($path)
    {
        return $this->base_url . $path;
    }

    protected function get($url, array $args = [])
    {
        // default to embed
        $args = array_merge(['_embed' => true], $args);
        $response = $this->client->get($url, $args);
        return json_decode($response->content());
    }

    public function posts(array $args = [])
    {
       $data = collect($this->get($this->url('posts'), $args));

       return $data->map(function($post_data) {
            return Post::createFromData($post_data);
       });
    }
}