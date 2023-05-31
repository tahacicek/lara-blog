<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Cateogry;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }

    public function create(Request $request)
    {
        $categories = Category::all();
        return view('admin.post.includes.create', compact('categories'));
    }

    public function insert(Request $request)
    {

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('post'), $imageName);
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->content = $request->content;
        $post->image = 'post/' . $imageName;
        if ($post->is_published == 'on') {
            $post->published_at = $request->published_at;
        } else {
            $post->published_at = null;
        }
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords = $request->meta_keywords;
        $post->tags = implode(',', $request->tags);
        $post->save();
        if ($post->save()) {
            $category = new PostCategory();
            foreach ($request->category as $category_id) {
                $category->post_id = $post->id;
                $category->category_id = $category_id;
            $category->save();

            }
        }
    }
}
