<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class PostController extends Controller
{
    public function __construct() {
    	// apply the policy to all resource class
    	$this->authorizeResource(Post::class, 'post');
    }

    public function create() {
    	auth()->loginUsingId(3);
    	$post = Post::first();
    	return view('posts.create', compact('post'));
    }

    public function update(Request $request, Post $post) {
    	return "s";
    }
}
