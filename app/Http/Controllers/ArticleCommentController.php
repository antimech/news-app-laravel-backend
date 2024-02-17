<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleCommentRequest;
use App\Http\Resources\ArticleCommentResource;
use App\Models\Article;
use App\Models\ArticleComment;
use Symfony\Component\HttpFoundation\Response;

class ArticleCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Article $article)
    {
        return ArticleCommentResource::collection(
            $article->comments()->orderByDesc('id')->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleCommentRequest $request, Article $article)
    {
        $articleComment = new ArticleComment();
        $articleComment->author()->associate($request->user());
        $articleComment->message = $request->input('message');
        $article->comments()->save($articleComment);

        return response(status: Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticleComment $comment)
    {
        $comment->delete();

        return response(status: Response::HTTP_NO_CONTENT);
    }
}
