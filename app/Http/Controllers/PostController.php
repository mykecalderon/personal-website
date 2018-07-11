<?php

namespace App\Http\Controllers;

use App\Services\WpApi;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $wp;

    public function __construct(WpApi $wp)
    {
        $this->wp = $wp;
    }

    public function show($slug) 
    {
        $post = $this->wp->posts(['slug' => 'my-test-post'])->first();

        return view('posts.show', compact('post'));
    }
}
