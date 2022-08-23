<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()
            ->has(Post::factory()->times(mt_rand(4, 15)))
            ->count(10000)
            ->create();
    }
}
