<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return Article::all();
        } else {
            return response()->json(['message' => 'Permission denied. User is not authenticated.'], 403);
        }
    }

    public function show(Article $article)
    {
        if (Auth::check()) {
            return $article;
        } else {
            return response()->json(['message' => 'Permission denied. User is not authenticated.'], 403);
        }
    }

    public function store(Request $request)
    {
        if (Auth::check()) {
            $article = Article::create($request->all());
            return response()->json($article, 201);
        } else {
            return response()->json(['message' => 'Permission denied. User is not authenticated.'], 403);
        }
    }

    public function update(Request $request, Article $article)
    {
        if (Auth::check()) {
            $article->update($request->all());
            return response()->json($article, 200);
        } else {
            return response()->json(['message' => 'Permission denied. User is not authenticated.'], 403);
        }
    }

    public function delete(Article $article)
    {
        if (Auth::check()) {
            $article->delete();
            return response()->json(null, 204);
        } else {
            return response()->json(['message' => 'Permission denied. User is not authenticated.'], 403);
        }
    }
}
// class ArticleController extends Controller
// {
//     public function index(){
//         return Article::all();
//     }

//     public function show(Article $article){
//         return ($article);
//     }

//     public function store(Request $request) {
//         $article = Article::create($request->all());
//         return response()->json($article,201);
//     }

//     public function update(Request $request, Article $article) {
//         $article->update($request->all());

//         return response()->json($article,200);
//     }

//     public function delete(Article  $article) {
//         $article->delete();

//         return response()->json(null,204);
//     }
// }
