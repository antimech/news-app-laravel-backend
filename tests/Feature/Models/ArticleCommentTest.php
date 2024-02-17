<?php

namespace Tests\Feature\Models;

use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleCommentTest extends TestCase
{
    public function test_an_article_comment_has_an_article(): void
    {
        $articleComment = ArticleComment::factory()->create();
        $article = Article::findOrFail($articleComment->article_id);

        $this->assertInstanceOf(Article::class, $articleComment->article);
        $this->assertTrue($articleComment->article->id === $article->id);
    }

    public function test_an_article_comment_has_an_author(): void
    {
        $articleComment = ArticleComment::factory()->create();
        $user = User::findOrFail($articleComment->user_id);

        $this->assertInstanceOf(User::class, $articleComment->author);
        $this->assertTrue($articleComment->author->id === $user->id);
    }
}
