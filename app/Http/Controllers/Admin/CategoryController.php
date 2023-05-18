<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cateogry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Cateogry::all();
        return view('admin.category.index', compact('categories'));
    }

    public function operations(Request $request)
    {
        switch ($request->type) {
            case 'create-category':
                if (!isset($request->type)) return response()->json(['error' => 'Gecersiz istek.'], 400);
                return response()->json(['success' => true, 'data' => view('admin.category.includes.create', ['type' => $request->type])->render()], 200);
                break;
            case 'insert-category':
                if (!isset($request->type)) return response()->json(['error' => 'Gecersiz istek.'], 400);
                $message = $request->validate([
                    'name' => 'required|string|max:255',
                ], [
                    'name.required' => 'Kategori adı boş bırakılamaz.',
                    'name.string' => 'Kategori adı metin olmalıdır.',
                    'name.max' => 'Kategori adı en fazla 255 karakter olmalıdır.',
                ]);
                $last = Cateogry::latest()->first('order');
                $category = new Cateogry();
                $category->name = $request->name;
                $category->slug = Str::slug($request->name);
                $category->description = $request->description;
                $category->meta_title = $request->meta_title;
                $category->meta_description = $request->meta_description;
                $category->meta_keywords = $request->meta_keywords;
                $category->status = $request->status;
                if (!isset($last->order)) {
                    $category->order = 1;
                } else {
                    $category->order = $last->order + 1;
                }
                $category->save();
                return response()->json(['success' => true, 'message' => 'Kategori başarıyla eklendi.'], 200);
                break;
                case 'category-sort';
                //category sıralaması güncelleme
                if (!isset($request->type)) return response()->json(['error' => 'Gecersiz istek.'], 400);
                dd($request->all());
                return response()->json(['success' => true, 'message' => 'Kategori sıralaması başarıyla güncellendi.'], 200);


                break;
            default:
                return response()->json(['error' => 'Gecersiz istek.'], 400);
                break;
        }
    }
}

