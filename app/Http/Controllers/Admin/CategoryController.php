<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function operations(Request $request)
    {
        switch ($request->type) {
            case 'create-category':
                if (!isset($request->type)) return response()->json(['error' => 'Gecersiz istek.'], 400);
                return response()->json(['success' => true, 'data' => view('admin.category.includes.create', ['type' => $request->type])->render()], 200);
                break;
            case 'edit-category':
                return view('admin.category.includes.create');
            default:
                return response()->json(['error' => 'Gecersiz istek.'], 400);
                break;
        }
    }
}
