<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Determine if the user can view the post.
     */
    public function view(User $user, Post $post): bool
    {
        return $user->hasRole('Admin') ||
            $user->hasRole('Author') ||
            $user->hasRole('Viewer');
    }

    /**
     * Determine if the user can update the post.
     */
    public function update(User $user, Post $post): bool
    {
        return $user->hasRole('Admin') ||
            $user->id === $post->user_id;
    }

    /**
     * Determine if the user can delete the post.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->hasRole('Admin') ||
            $user->id === $post->user_id;
    }

    /**
     * (Optional) Determine if the user can create posts.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Admin') || $user->hasRole('Author');
    }
}
