<?php

namespace App\Providers;

use App\Repositories\Users\EloquentUserRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Support\ServiceProvider;

class RegisterModelRepositoriesProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
    }
}
