<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected Builder $schema;

    protected string $table;

    public function __construct()
    {
        $config = Config::get('softswiss.providers.game');
        $this->schema = Schema::connection($config['connection']);
        $this->table = $config['table_name'];
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->schema->create($this->table, static function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title')
                ->comment('Game title');

            $table->string('slug')
                ->unique()
                ->comment('Game slug');

            $table->string('identifier')
                ->unique()
                ->comment('Game identifier');

            $table->string('feature_group')
                ->nullable()
                ->comment('Game feature group');

            $table->json('devices')
                ->nullable()
                ->comment('Game available devices');

            $table->string('identifier2')
                ->nullable('')
                ->comment('Game identifier 2');

            $table->string('producer')
                ->nullable()
                ->comment('Game producer');

            $table->boolean('has_freespins')
                ->nullable()
                ->comment('Game has free spins');

            $table->float('payout')
                ->nullable()
                ->comment('Game payout');

            $table->string('volatility_rating')
                ->nullable()
                ->comment('Game volatility rating');

            $table->boolean('has_jackpot')
                ->nullable()
                ->comment('Game has jackpot');

            $table->integer('lines')
                ->nullable()
                ->comment('Game lines');

            $table->integer('ways')
                ->nullable()
                ->comment('Game ways');

            $table->text('description')
                ->nullable()
                ->comment('Game description');

            $table->boolean('has_live')
                ->nullable()
                ->comment('Game has live');

            $table->boolean('hd')
                ->nullable()
                ->comment('Game hd');

            $table->float('multiplier')
                ->nullable()
                ->comment('Game multiplier');

            $table->boolean('bonus_buy')
                ->nullable()
                ->comment('Game bonus buy');

            $table->timestamp('released_at')
                ->nullable()
                ->comment('Game released at');

            $table->timestamp('recalled_at')
                ->nullable()
                ->comment('Game recalled at');

            $table->foreign('provider_id')
                ->references('id')
                ->on(Config::get('softswiss.providers.provider.table_name'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema->dropIfExists($this->table);
    }
};
