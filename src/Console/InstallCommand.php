<?php

namespace Pow10s\Softswiss\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'softswiss:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install all of the Softswiss resources';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->comment('Publishing Softswiss Configuration...');
        $this->callSilent('vendor:publish', ['--tag' => 'softswiss-config']);

        $this->comment('Publishing Softswiss Migrations...');
        $this->callSilent('vendor:publish', ['--tag' => 'softswiss-migrations']);

        $this->info('Softswiss scaffolding installed successfully.');
    }
}
