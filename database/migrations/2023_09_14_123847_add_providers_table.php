<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration
{
    protected Builder $schema;

    protected string $table;

    public function __construct()
    {
        $config = Config::get('softswiss.providers.provider');
        $this->schema = Schema::connection($config['connection']);
        $this->table = $config['table_name'];
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->schema->create($this->table, static function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')
                ->comment('Provider title');

            $table->string('slug')
                ->unique()
                ->comment('Provider slug');

            $table->text('description')
                ->nullable()
                ->comment('Provider description');

            $table->boolean('is_enabled')
                ->default(true)
                ->comment('Provider is enabled');

            $table->integer('position')
                ->nullable()
                ->comment('Provider position');

            $table->json('accepted_currencies')
                ->nullable()
                ->comment('Provider accepted currencies');

            $table->json('country_restriction')
                ->nullable()
                ->comment('Provider restricted countries');

            $table->timestamps();
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
