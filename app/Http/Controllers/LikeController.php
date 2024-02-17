<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LikeController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $userLikes = $request->user()->likes();
        $existingLike = $userLikes
            ->where('article_id', $article->id)
            ->first();

        if ($existingLike) {
            return response()->json(['message' => 'You have already liked the article.']);
        }

        $article->likes()->create(['user_id' => $request->user()->id]);

        return response(status: Response::HTTP_CREATED);
    }

    public function destroy(Article $article)
    {
        $article->likes()
            ->where('user_id', request()->user()->id)
            ->delete();

        return response(status: Response::HTTP_NO_CONTENT);
    }
}
