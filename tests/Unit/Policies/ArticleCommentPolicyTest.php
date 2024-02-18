<?php

namespace Tests\Unit\Policies;

use App\Models\ArticleComment;
use App\Policies\ArticleCommentPolicy;
use Tests\TestCase;
use App\Models\User;

class ArticleCommentPolicyTest extends TestCase
{
    public function test_unauthenticated_user_can_view_any_article_comment()
    {
        // Create an instance of the policy
        $policy = new ArticleCommentPolicy();

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
        $policy = new ArticleCommentPolicy();

        // Check if the user can view any articles
        $this->assertTrue($policy->viewAny($user));
    }

    public function test_user_can_delete_own_article()
    {
        // Create a user
        $user = User::factory()->create();

        // Create an article owned by the user
        $articleComment = ArticleComment::factory()->create(['user_id' => $user->id]);

        // Mock the user
        $this->actingAs($user);

        // Create an instance of the policy
        $policy = new ArticleCommentPolicy();

        // Check if the user can delete their own article
        $this->assertTrue($policy->delete($user, $articleComment));
    }

    public function test_user_cannot_delete_other_users_article()
    {
        // Create two users
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // Create an article comment owned by user1
        $articleComment = ArticleComment::factory()->create(['user_id' => $user1->id]);

        // Mock user2
        $this->actingAs($user2);

        // Create an instance of the policy
        $policy = new ArticleCommentPolicy();

        // Check if user2 can delete user1's article
        $this->assertFalse($policy->delete($user2, $articleComment));
    }
}
