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
        //validate
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg',
            'category' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('post'), $imageName);
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->content = $request->content;
        $post->image = 'post/' . $imageName;
        if ($post->is_published == 'on') {
            $post->published_at = null;
        } else {
            $post->published_at = $request->published_at;
        }
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords = $request->meta_keywords;
        $post->tags = implode(',', $request->tags);
        $post->save();
        if ($post->save()) {
            foreach ($request->category as $category_id) {
                $category = new PostCategory();
                $category->post_id = $post->id;
                $category->category_id = $category_id;
                $category->save();
            }
        }

        return redirect()->back()->with('message', 'Post created successfully');
    }

    public function edit(Request $request)
    {
        $post = Post::find($request->id);
        //post tags'ı virgülleri kaldır foreacha sok
        $post_tags = explode(',', $post->tags);
        $post->tags = $post_tags;

        $categoryPost = PostCategory::where('post_id', $request->id)->get();
        $categories = Category::all();
        return view('admin.post.includes.edit', compact('post', 'categories', 'categoryPost', 'post_tags'));
    }

    public function update(Request $request)
    {
        //validate
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'image' => 'mimes:jpg,png,jpeg',
            'category' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
        ]);

        $post = Post::find($request->id);
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->content = $request->content;
        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('post'), $imageName);
            $post->image = 'post/' . $imageName;
        }
        if ($post->is_published == 'on') {
            $post->published_at = null;
        } else {
            $post->published_at = $request->published_at;
        }
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords = $request->meta_keywords;
        $post->tags = implode(',', $request->tags);
        $post->save();
        if ($post->save()) {
            PostCategory::where('post_id', $request->id)->delete();
            foreach ($request->category as $category_id) {
                $category = new PostCategory();
                $category->post_id = $post->id;
                $category->category_id = $category_id;
                $category->save();
            }
        }
        return redirect()->back()->with('message', 'Post updated successfully');
    }

    public function operations(Request $request)
    {
        switch ($request->type) {
            case 'delete-post':
                if (!isset($request->type)) return response()->json(['error' => 'Gecersiz istek.'], 400);
                $post = Post::find($request->id);
                $postCat = PostCategory::where('post_id', $request->id)->get();
                foreach ($postCat as $cat) {
                    $cat->delete();
                }
                $post->delete();
                return response()->json(['success' => true, 'message' => 'Post başarıyla silindi.'], 200);
                break;
            case 'recycle-post':
                if (!isset($request->type)) return response()->json(['error' => 'Gecersiz istek.'], 400);
                $posts = Post::onlyTrashed()->orderBy('deleted_at', 'ASC')->get();
                $postCat = PostCategory::with('category')->onlyTrashed()->orderBy('deleted_at', 'ASC')->get();
                return response()->json(['success' => true, 'data' => view('admin.post.includes.recycle', ['posts' => $posts, 'postCat' => $postCat])->render()], 200);
                break;
            case 'cover-post':
                if (!isset($request->type)) return response()->json(['error' => 'Gecersiz istek.'], 400);
                $id = $request->id;
                $post = Post::onlyTrashed()->find($id);
                $postCat = PostCategory::with('category')->onlyTrashed()->where('post_id', $id)->get();
                foreach ($postCat as $cat) {
                    $cat->restore();
                }
                $post->restore();
                return response()->json(['success' => true, 'message' => 'Yazı başarıyla kurtarıldı.'], 200);
                break;
            case 'trash-post':
                if (!isset($request->type)) return response()->json(['error' => 'Gecersiz istek.'], 400);
                $id = $request->id;
                $post = Post::onlyTrashed()->find($id);
                $postCat = PostCategory::with('category')->onlyTrashed()->where('post_id', $id)->get();
                foreach ($postCat as $cat) {
                    $cat->forceDelete();
                }
                $post->forceDelete();
                return response()->json(['success' => true, 'message' => 'Yazı başarıyla silindi.'], 200);
                break;
            default:
                return response()->json(['error' => 'Gecersiz istek.'], 400);
                break;
        }
    }

    //demo 15 post
    public function demo()
    {
        //if this route works, create 15 fake posts
        for ($i = 0; $i < 15; $i++) {
            $post = new Post();
            $post->title = 'Demo Post ' . $i;
            $post->slug = Str::slug('Demo Post ' . $i);
            $post->content = 'Lorem ipsum dolor sit amet consectetur adipisicing e';
            $post->image = 'post/demo.jpg';
            $post->published_at = now();
            $post->meta_title = 'Demo Post ' . $i;
            $post->meta_description = 'Demo Post ' . $i;
            $post->meta_keywords = 'Demo Post ' . $i;
            $post->tags = 'Demo Post ' . $i;
            $post->save();
            sleep(3);

            $category = new PostCategory();
            $category->post_id = $post->id;
            $category->category_id = 1;
            $category->save();
        }
    }
}
