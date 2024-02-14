<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ArticleResource::collection(
            Article::orderByDesc('id')->paginate()
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $article->increment('views');

        return new ArticleResource($article);
    }
}
