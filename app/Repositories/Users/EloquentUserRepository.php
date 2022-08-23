<?php

namespace App\Repositories\Users;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class EloquentUserRepository implements UserRepository
{
    private Model $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getMostActiveUsers(int $minPostsCount, int $duration): Collection
    {
        return $this->model->query()
            ->select('username')
            ->withCount(['posts as total_posts_count' => fn (Builder $query) =>
                $query->whereDate('created_at', '>=', now()->subDays($duration))
            ])
            ->addSelect(['last_post_title' => Post::query()
                ->select('title')
                ->whereColumn('users.id', 'posts.user_id')
                ->latest()
                ->take(1)
            ])
            ->where('total_posts_count', '>=', $minPostsCount)
            ->getQuery() // prevent model hydration
            ->get();
    }
}
