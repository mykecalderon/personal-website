<?php

namespace App\Http\Controllers;

use App\Services\WpApi;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $wp;

    public function __construct(WpApi $wp)
    {
        $this->wp = $wp;
    }

    public function index() 
    {
        $posts = $this->wp->posts();

        return view('blog.index', compact('posts'));
    }
}
