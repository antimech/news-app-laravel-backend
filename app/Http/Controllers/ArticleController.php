<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

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
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $hashFileName = $request->file('image')->hashName();

        $request->file('image')->storePubliclyAs('public/images', $hashFileName);

        $validated = $request->validated();
        $validated['image'] = $hashFileName;

        return auth()->user()->articles()->create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $article->increment('views');

        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response(status: 204);
    }
}
