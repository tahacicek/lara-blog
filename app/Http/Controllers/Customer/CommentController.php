<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function commentFunc(Request $request)
    {
        switch ($request->type) {
            case 'comment-post':
                if (!isset($request->type)) return response()->json(['error' => 'Gecersiz istek.'], 400);
                $comment = new Comment();
                $comment->post_id = $request->post_id;
                $comment->user_id = Auth::user()->id;
                $comment->body = $request->body;
                $comment->save();
                return response()->json(['success' => 'Yorumunuz basariyla eklendi.'], 200);
                break;
            default:
                return response()->json(['error' => 'Gecersiz istek.'], 400);
                break;
        }
    }
}
