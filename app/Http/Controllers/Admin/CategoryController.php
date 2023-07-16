<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryController extends Controller
{
    public function index()
    {
        //order'a göre ilk dördünü gönder
        $categories = Category::orderBy('order', 'ASC')->paginate(4);
        //ilk dörtlü dışında diğerlerini gönder
        $categories->fragment('categories');
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
                $last = Category::latest()->first('order');
                $category = new Category();
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
            case 'edit-category';
                //category sıralaması güncelleme
                if (!isset($request->type)) return response()->json(['error' => 'Gecersiz istek.'], 400);
                $id = $request->id;
                $category = Category::find($id);
                return response()->json(['success' => true, 'data' => view('admin.category.includes.create', ['type' => $request->type, 'category' => $category])->render()], 200);
                break;
            case 'update-category':
                if (!isset($request->type)) return response()->json(['error' => 'Gecersiz istek.'], 400);
                $message = $request->validate([
                    'name' => 'required|string|max:255',
                ], [
                    'name.required' => 'Kategori adı boş bırakılamaz.',
                    'name.string' => 'Kategori adı metin olmalıdır.',
                    'name.max' => 'Kategori adı en fazla 255 karakter olmalıdır.',
                ]);
                $id = $request->id;
                $category = Category::find($id);
                $category->name = $request->name;
                $category->slug = Str::slug($request->name);
                $category->description = $request->description;
                $category->meta_title = $request->meta_title;
                $category->meta_description = $request->meta_description;
                $category->meta_keywords = $request->meta_keywords;
                $category->status = $request->status;
                $category->save();
                return response()->json(['success' => true, 'message' => 'Kategori başarıyla güncellendi.'], 200);
                break;
            case 'delete-category':
                if (!isset($request->type)) return response()->json(['error' => 'Gecersiz istek.'], 400);
                //softdelete
                $id = $request->id;
                $category = Category::find($id);
                $category->delete();
                return response()->json(['success' => true, 'message' => 'Kategori başarıyla geri dönüşüm kutusuna yollandı.'], 200);
                break;
            case 'recycle-category':
                if (!isset($request->type)) return response()->json(['error' => 'Gecersiz istek.'], 400);
                $categories = Category::onlyTrashed()->orderBy('deleted_at', 'ASC')->get();
                return response()->json(['success' => true, 'data' => view('admin.category.includes.recycle', ['type' => $request->type, 'categories' => $categories])->render()], 200);
                break;
            case 'cover-category':
                if (!isset($request->type)) return response()->json(['error' => 'Gecersiz istek.'], 400);
                //kategori kurtarma
                $id = $request->id;
                $category = Category::onlyTrashed()->find($id);
                $category->restore();
                return response()->json(['success' => true, 'message' => 'Kategori başarıyla kurtarıldı.'], 200);
                break;
            case 'trash-category':
                if (!isset($request->type)) return response()->json(['error' => 'Gecersiz istek.'], 400);
                $id = $request->id;
                $category = Category::onlyTrashed()->find($id);
                $category->forceDelete();
                return response()->json(['success' => true, 'message' => 'Kategori başarıyla silindi.'], 200);
                break;
            default:
                return response()->json(['error' => 'Gecersiz istek.'], 400);
                break;
        }
    }

    public function order(Request $request)
    {
        foreach ($request->get("category") as $key => $order) {
            Category::where("id", $order)->update(["order" => $key]);
        }
        return response()->json(['success' => true, 'message' => 'Kategori sıralaması başarıyla güncellendi.'], 200);
    }

}
