<?php

namespace Tests\Unit\Policies;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use App\Policies\ArticlePolicy;

class ArticlePolicyTest extends TestCase
{
    public function test_unauthenticated_user_can_view_any_articles()
    {
        // Create an instance of the policy
        $policy = new ArticlePolicy();

        // Check if the unauthenticated user can view any articles
        $this->assertTrue($policy->viewAny(null));
    }

    public function test_user_can_view_any_articles()
    {
        // Create a user
        $user = User::factory()->create();

        // Mock the user
        $this->actingAs($user);

        // Create an instance of the policy
        $policy = new ArticlePolicy();

        // Check if the user can view any articles
        $this->assertTrue($policy->viewAny($user));
    }

    public function test_user_can_view_article()
    {
        // Create an article
        $article = Article::factory()->create();

        // Create a user
        $user = User::factory()->create();

        // Mock the user
        $this->actingAs($user);

        // Create an instance of the policy
        $policy = new ArticlePolicy();

        // Check if the user can view the published article
        $this->assertTrue($policy->view($user, $article));
    }

    public function test_unauthenticated_user_can_view_article()
    {
        // Create an article
        $article = Article::factory()->create();

        // Create an instance of the policy
        $policy = new ArticlePolicy();

        // Check if the user can view the published article
        $this->assertTrue($policy->view(null, $article));
    }

    public function test_user_can_delete_own_article()
    {
        // Create a user
        $user = User::factory()->create();

        // Create an article owned by the user
        $article = Article::factory()->create(['user_id' => $user->id]);

        // Mock the user
        $this->actingAs($user);

        // Create an instance of the policy
        $policy = new ArticlePolicy();

        // Check if the user can delete their own article
        $this->assertTrue($policy->delete($user, $article));
    }

    public function test_user_cannot_delete_other_users_article()
    {
        // Create two users
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // Create an article owned by user1
        $article = Article::factory()->create(['user_id' => $user1->id]);

        // Mock user2
        $this->actingAs($user2);

        // Create an instance of the policy
        $policy = new ArticlePolicy();

        // Check if user2 can delete user1's article
        $this->assertFalse($policy->delete($user2, $article));
    }
}