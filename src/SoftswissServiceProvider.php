<?php

declare(strict_types=1);

namespace Pow10s\Softswiss;

use Illuminate\Support\ServiceProvider;

class SoftswissServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/softswiss.php', 'softswiss');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/softswiss.php' => config_path('softswiss.php'),
        ], 'config');
    }
}
