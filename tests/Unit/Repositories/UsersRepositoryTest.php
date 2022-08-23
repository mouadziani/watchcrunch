<?php

namespace Tests\Unit\Repositories;

use App\Models\Post;
use App\Models\User;
use App\Repositories\Users\EloquentUserRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private UserRepository $userRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = new EloquentUserRepository(new User);
    }

    /** @test */
    public function it_get_most_active_users_for_a_specific_duration()
    {
        User::factory()
            ->has(Post::factory(['created_at' => now()->subDays(3)])->count(2))
            ->count(10)
            ->create();

        $user1 = User::factory()
            ->has(Post::factory(['title' => 'last post user1', 'created_at' => now()->subDays(7)]))
            ->has(Post::factory(['created_at' => now()->subDays(7)])->count(12))
            ->create();

        $user2 = User::factory()
            ->has(Post::factory(['title' => 'last post user2', 'created_at' => now()->subDays(7)]))
            ->has(Post::factory(['created_at' => now()->subDays(7)])->count(10))
            ->create();

        $activeUsers = $this->userRepository->getMostActiveUsers(10, 7);

        $expected = collect();
        $expected->push((object) [
            'username' => $user1->username,
            'total_posts_count' => 13,
            'last_post_title' => 'last post user1'
        ]);
        $expected->push((object) [
            'username' => $user2->username,
            'total_posts_count' => 11,
            'last_post_title' => 'last post user2'
        ]);

        $this->assertEquals(2, $activeUsers->count());
        $this->assertEquals($expected->toArray(), $activeUsers->toArray());
    }
}
