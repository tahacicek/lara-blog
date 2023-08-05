<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //kategory share
        view()->composer('*', function ($view) {
            $categories = \App\Models\Category::where('status', 'active')->orderBy('order', 'ASC')->get();
            $view->with('categories', $categories);
        });
        Paginator::useBootstrap();

        view()->composer('customer.includes.sidebar-widget', function ($view) {
            $catPost = self::widget();
            $view->with('catPost', $catPost);
        });
    }

    public static function widget()
    {
        // All categories and tags
        $posts = Post::with('postCategory')->where('is_published', 0)->orderBy('hit', 'DESC')->get();
        // en çok hit alan 5 postu alıyoruz
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
        //return $catPost and $posts
        return array($catPost, $posts);
    }
}
