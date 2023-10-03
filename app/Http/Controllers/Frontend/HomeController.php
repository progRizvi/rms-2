<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->paginate(10);
        return view('frontend.pages.home', compact('posts'));
    }
    public function categoryDetails($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $posts = $category->posts()->paginate(10);
        return view('frontend.pages.categoryDetails', compact('posts', "category"));
    }
    public function postDetails($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $category = $post->category;
        $relatedPost = Post::where('category_id', $category->id)->where('id', '!=', $post->id)->get();
        return view('frontend.pages.postDetail', compact('post', 'relatedPost'));
    }
    public function postSearch()
    {
        $search = request()->search;
        $posts = Post::where('title', 'like', "%$search%")->paginate(10);
        return view('frontend.pages.categoryDetails', compact('posts'));
    }
}
