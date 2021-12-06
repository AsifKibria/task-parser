<?php

namespace Task\CollectionParser\Providers;

use Task\CollectionParser\Commands\ModelPublish;
use Illuminate\Support\ServiceProvider;

class CollectionParserServiceProvider  extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/route.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'task-parser');
        $this->loadViewsFrom(__DIR__.'/../../resources/stubs', 'stubs');
        $this->commands([
            ModelPublish::class
        ]);

    }
}
