<?php

namespace Tests\Feature\Models;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    public function test_an_article_has_an_author(): void
    {
        $article = Article::factory()->create();
        $user = User::findOrFail($article->user_id);

        $this->assertInstanceOf(User::class, $article->author);
        $this->assertTrue($article->author->id === $user->id);
    }

    public function test_an_article_has_a_image_url(): void
    {
        $article = Article::factory()->create();
        $expectedUrl = asset('storage/images/' . $article->image);

        $this->assertSame($expectedUrl, $article->image_url);
    }
}
