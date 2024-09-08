<?php

declare(strict_types=1);

namespace Pow10s\Softswiss;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Pow10s\Softswiss\Client\APIClient;
use Pow10s\Softswiss\Client\Interfaces\SoftswissAPIClientInterface;
use Pow10s\Softswiss\Console\InstallCommand;
use Pow10s\Softswiss\Console\UploadGamesCommand;

class SoftswissServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/softswiss.php', 'softswiss');

        $this->registerAPIClient();
    }

    public function boot(): void
    {
        $this->registerCommands();
        $this->registerPublishing();
        if (Config::get('softswiss.enabled') === false) {
            return;
        }

        Route::middlewareGroup('softswiss', Config::get('softswiss.middleware', []));

        $this->registerRoutes();
//        $this->registerMigrations();
    }

    public function registerRoutes(): void
    {
        Route::group(
            [
                'prefix' => Config::get('softswiss.path'),
                'namespace' => 'Pow10s\Softswiss\Http\Controllers',
                'middleware' => 'softswiss',
            ],
            function () {
                $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
            }
        );
    }

    public function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/softswiss.php' => $this->app->configPath('softswiss.php'),
            ], 'softswiss-config');

            $this->publishes([
                __DIR__ . '/../database/migrations' => $this->app->databasePath('migrations'),
            ], 'softswiss-migrations');
        }
    }

    public function registerMigrations(): void
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }
    }

    public function registerAPIClient(): void
    {
        $this->app->singleton(SoftswissAPIClientInterface::class, APIClient::class);
    }

    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                UploadGamesCommand::class,
            ]);
        }
    }
}
