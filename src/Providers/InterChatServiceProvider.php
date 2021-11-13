<?php

namespace Pruteanu\InterChat\Providers;

use Illuminate\Support\ServiceProvider;

class InterChatServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/inter-chat-config.php' => config_path('inter-chat.php'),
        ], 'inter-chat-config');

        $this->loadMigrationsFrom(__DIR__.'/../../migrations');
        $this->loadRoutesFrom(__DIR__.'/../../routes/inter-chat.php');
    }

    public function register()
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Chat', "Pruteanu\\InterChat\\Facades\\Chat");
    }
}
