<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        // Assuming authorization policy tests cover this scenario, so we don't test it here.
        // Override the "authorize" method of the Gate facade with a no-op function
        Gate::shouldReceive('authorize')->andReturn(true);

        $articles = Article::factory()->count(3)->create();

        $response = $this->get('/api/articles');

        $response
            ->assertOk()
            ->assertSee($articles[0]->title);
    }

    public function test_show(): void
    {
        // Assuming authorization policy tests cover this scenario, so we don't test it here.
        // Override the "authorize" method of the Gate facade with a no-op function
        Gate::shouldReceive('authorize')->andReturn(true);

        $article = Article::factory()->create();

        $response = $this->get('/api/articles/' . $article->id);

        $response
            ->assertOk()
            ->assertSee($article->title);
    }

    public function test_destroy(): void
    {
        // Assuming authorization policy tests cover this scenario, so we don't test it here.
        // Override the "authorize" method of the Gate facade with a no-op function
        Gate::shouldReceive('authorize')->andReturn(true);

        $article = Article::factory()->create();

        $this->actingAs($article->author);

        $response = $this->delete('/api/articles/' . $article->id);

        $response->assertNoContent();
    }
}
