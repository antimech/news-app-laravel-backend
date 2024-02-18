<?php

namespace App\Policies;

use App\Models\ArticleComment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticleCommentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ArticleComment $articleComment): bool
    {
        return $user->id === $articleComment->user_id;
    }
}
