<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'article_id'
    ];

    const UPDATED_AT = null;

    /**
     * Get the user of the like.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the article of the like.
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
