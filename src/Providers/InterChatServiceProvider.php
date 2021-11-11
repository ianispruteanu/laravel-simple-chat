<?php

namespace Pruteanu\InterChat\Providers;

use Illuminate\Support\ServiceProvider;

class InterChatServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../migrations');
        $this->loadRoutesFrom(__DIR__.'/../../routes/inter-chat.php');
    }

    public function register()
    {

    }
}
