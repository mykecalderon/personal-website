<?php

namespace App\Http\Controllers;

use App\Services\WpApi;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(WpApi $wp, $slug) 
    {
        $post = $wp->posts(['slug' => 'my-test-post'])->first();

        return view('posts.show', compact('post'));
    }
}
