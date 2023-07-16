<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', 0)->with('postCategory')->get();
        $catPost = PostCategory::all();
        $categories = Category::orderBy('order', 'ASC')->paginate(4);
        $categorysPost = [];
        //ilk dört kategoriyi ve ona ait postları al sadece
        foreach ($categories as $category) {
            $categorysPost[] = PostCategory::where('category_id', $category->id)->with('post')->get();
        }
        $catPost = $categorysPost;
        //example catPost foreach

        return view('customer.index', compact('posts', 'catPost', 'categories'));
    }

    public function postDetail($slug){
        $post = Post::where('slug', $slug)->first() ?? abort(403 ,"Böyle bir yazı bulunamadı.");
        return view('customer.includes.post-detail', compact('post'));
    }
}
