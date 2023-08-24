<?php

namespace Pow10s\Softswiss\Console;

use Illuminate\Console\Command;
use Pow10s\Softswiss\Client\Interfaces\SoftswissAPIClientInterface;

class UploadGamesCommand extends Command
{
    public function __construct(
        protected readonly SoftswissAPIClientInterface $client
    )
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'softswiss:games:update {providers*} {--with-producer}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload games from providers to database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $providers = $this->argument('providers');
        foreach ($providers as $provider) {
            $this->client->fetchGamesByProvider($provider);
        }
    }
}
