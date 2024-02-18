<?php

namespace Tests\Feature\Models;

use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_a_user_can_have_articles()
    {
        $user = User::factory()->create();

        Article::factory()
            ->count(3)
            ->for($user, 'author')
            ->create();

        $this->assertCount(3, $user->articles);
        $this->assertInstanceOf(Article::class, $user->articles->first());
    }

    public function test_a_user_can_have_article_comments()
    {
        $user = User::factory()->create();
        $articleComments = ArticleComment::factory(3)->for($user, 'author')->create();

        $this->assertCount($articleComments->count(), $user->articleComments);

        foreach ($user->articleComments as $comment) {
            $this->assertInstanceOf(ArticleComment::class, $comment);
        }
    }
}
