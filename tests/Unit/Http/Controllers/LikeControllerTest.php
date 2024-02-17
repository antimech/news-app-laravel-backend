<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\LikeController;
use App\Models\Article;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Tests\TestCase;

class LikeControllerTest extends TestCase
{
    public function test_store()
    {
        $user = User::factory()->create();

        request()->setUserResolver(fn() => $user);

        $article = Article::factory()->create();

        $controller = new LikeController();
        $response = $controller->store(request(), $article);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(SymfonyResponse::HTTP_CREATED, $response->status());
    }

    public function test_destroy()
    {
        $user = User::factory()->create();

        request()->setUserResolver(fn() => $user);

        $article = Article::factory()->create();
        Like::create([
            'user_id' => $user->id,
            'article_id' => $article->id
        ]);

        $controller = new LikeController();
        $response = $controller->destroy($article);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(SymfonyResponse::HTTP_NO_CONTENT, $response->status());
    }
}
