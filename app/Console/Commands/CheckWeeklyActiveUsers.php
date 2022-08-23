<?php

namespace App\Console\Commands;

use App\Repositories\Users\UserRepository;
use Illuminate\Console\Command;

class CheckWeeklyActiveUsers extends Command
{
    public const MIN_POSTS_COUNT = 1;

    protected $signature = 'weekly-active-users:check {postsCount? : min count of posts}';

    protected $description = 'Check the weekly active users';

    public function handle(UserRepository $userRepository)
    {
        $postsCount = (int) ($this->argument('postsCount') ?? self::MIN_POSTS_COUNT);

        $userRepository->getMostActiveUsers($postsCount, 7);
    }
}
