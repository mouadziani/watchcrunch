<?php

namespace App\Repositories\Users;

use Illuminate\Support\Collection;

interface UserRepository
{
    public function getMostActiveUsers(int $minPostsCount, int $duration): Collection;
}
