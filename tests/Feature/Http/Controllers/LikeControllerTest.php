<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Article;
use App\Models\Like;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikeControllerTest extends TestCase
{
    public function test_a_user_can_like_an_article(): void
    {
        $article = Article::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post("/api/articles/$article->id/like");

        $response->assertCreated();
    }

    public function test_a_user_can_unlike_an_article()
    {
        $article = Article::factory()->create();
        $user = User::factory()->create();
        Like::create([
            'user_id' => $user->id,
            'article_id' => $article->id
        ]);

        $this->actingAs($user);

        $response = $this->delete("/api/articles/$article->id/like");

        $response->assertNoContent();
    }

    public function test_a_user_cannot_like_an_article_twice()
    {
        $article = Article::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->post("/api/articles/$article->id/like");
        $secondResponse = $this->post("/api/articles/$article->id/like");

        $likeCount = Like::where([
            'user_id' => $user->id,
            'article_id' => $article->id
        ])->count();

        $this->assertSame(1, $likeCount);
        $secondResponse->assertOk();
    }
}
