<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
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

    public function postDetail($category_name, $slug)
    {
        $post = Post::where('slug', $slug)->with('postCategory')->first();
        $post->hit = $post->hit + 1;
        $post->save();
        $categories = Category::with('postCategory')->get();
        $comments = Comment::where('post_id', $post->id)->with('user')->get();
        $postTagCat = [];
        //kategorilerin isimlerini alıp postta aynı olanları arraye atıyoruz
        foreach ($categories as $category) {
            foreach ($post->postCategory as $postCategory) {
                if ($category->id == $postCategory->category_id) {
                    $postTagCat['category'][] = $category->name;
                }
            }
        }
        $postTagCat['tags'] = explode(',', $post->tags);
        $user = User::where('role', 'admin')->first();

        // All categories and tags
        $posts = Post::with('postCategory')->get();
        $catPost = PostCategory::all();
        $categorysPost = [];
        //tüm kategorileri ve etiketleri alıyoruz
        foreach ($categories as $category) {
            foreach ($posts as $post) {
                foreach ($post->postCategory as $postCategories) {
                    if ($category->id == $postCategories->category_id) {
                        $categorysPost['category'][] = $category->name;
                    }
                }
            }
        }
        foreach ($posts as $post) {
            $categorysPost['tags'][] = explode(',', $post->tags);
        }

        $catPost = $categorysPost;
        // aynı kategorilerin sayılarını bulup arraye atıyoruz
        $catPost['category'] = array_count_values($catPost['category']);
        // aynı olan kategorileri ve etiketleri silip sadece bir tane bırakıyoruz
        $catPost['category'] = array_unique($catPost['category']);

        return view('customer.includes.post-detail', compact('post', 'postTagCat', 'user', 'catPost', 'comments'));
    }

    public function categoryDetail($category_name)
    {
        $category = Category::where('slug', $category_name)->first();
        $posts = PostCategory::where('category_id', $category->id)->with('post')->paginate(5);
        $categories = Category::with('postCategory')->get();
        $catPost = PostCategory::all();
        $categorysPost = [];
        // //tüm kategorileri ve etiketleri alıyoruz
        // foreach ($categories as $category) {
        //     foreach ($posts as $post) {
        //         if ($category->id == $post->category_id) {
        //             $categorysPost['category'][] = $category->name;
        //         }
        //     }
        // }
        // foreach ($posts as $post) {
        //     $categorysPost['tags'][] = explode(',', $post->tags);
        // }
        // $catPost = $categorysPost;
        // // aynı kategorilerin sayılarını bulup arraye atıyoruz
        // $catPost['category'] = array_count_values($catPost['category']);
        // // aynı olan kategorileri ve etiketleri silip sadece bir tane bırakıyoruz
        // $catPost['category'] = array_unique($catPost['category']);
        return view('customer.includes.category-detail', compact('posts', 'category', 'catPost'));
    }

    public function widget(){
        // All categories and tags
        $posts = Post::with('postCategory')->get();
        $catPost = PostCategory::all();
        $categories = Category::with('postCategory')->get();
        $categorysPost = [];
        //tüm kategorileri ve etiketleri alıyoruz
        foreach ($categories as $category) {
            foreach ($posts as $post) {
                foreach ($post->postCategory as $postCategories) {
                    if ($category->id == $postCategories->category_id) {
                        $categorysPost['category'][] = $category->name;
                    }
                }
            }
        }
        foreach ($posts as $post) {
            $categorysPost['tags'][] = explode(',', $post->tags);
        }

        $catPost = $categorysPost;
        // aynı kategorilerin sayılarını bulup arraye atıyoruz
        $catPost['category'] = array_count_values($catPost['category']);
        // aynı olan kategorileri ve etiketleri silip sadece bir tane bırakıyoruz
        $catPost['category'] = array_unique($catPost['category']);
    }
}
