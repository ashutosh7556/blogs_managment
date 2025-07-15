<?php
namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
      public function view(?User $user, Post $post): bool
      {
          return optional($user)->hasRole('admin') ||
                 optional($user)->hasRole('author') ||
                 optional($user)->hasRole('viewer');
      }


    public function update(User $user, Post $post): bool
    {
        return $user->hasRole('admin') ||
               ($user->hasRole('author') && $user->id === $post->user_id);
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->hasRole('admin') ||
               ($user->hasRole('author') && $user->id === $post->user_id);
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('author');
    }
}
