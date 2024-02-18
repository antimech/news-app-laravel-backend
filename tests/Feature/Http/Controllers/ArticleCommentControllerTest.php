<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class ArticleCommentControllerTest extends TestCase
{
    public function test_index(): void
    {
        // Assuming authorization policy tests cover this scenario, so we don't test it here.
        // Override the "authorize" method of the Gate facade with a no-op function
        Gate::shouldReceive('authorize')->andReturn(true);

        $articleComments = ArticleComment::factory()->count(3)->create();
        $articleId = $articleComments[0]->article->id;

        $response = $this->get("/api/articles/$articleId/comments");

        $response
            ->assertOk()
            ->assertSee($articleComments[0]->title);
    }

    public function test_store(): void
    {
        $article = Article::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post("/api/articles/$article->id/comments", [
            'message' => 'Test.'
        ]);

        $response->assertCreated();
    }

    public function test_destroy(): void
    {
        // Assuming authorization policy tests cover this scenario, so we don't test it here.
        // Override the "authorize" method of the Gate facade with a no-op function
        Gate::shouldReceive('authorize')->andReturn(true);

        $articleComment = ArticleComment::factory()->create();

        $this->actingAs($articleComment->author);

        $response = $this->delete("/api/comments/$articleComment->id");

        $response->assertNoContent();
    }
}
