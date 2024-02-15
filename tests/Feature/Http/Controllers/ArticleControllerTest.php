<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        $response = $this->get('/api/articles');

        $response->assertOk();
    }

    public function test_show(): void
    {
        $article = Article::factory()->create();

        $response = $this->get('/api/articles/' . $article->id);

        $response->assertOk();
    }

    public function test_destroy(): void
    {
        $article = Article::factory()->create();

        $this->actingAs($article->author);

        $response = $this->delete('/api/articles/' . $article->id);

        $response->assertNoContent();
    }
}
