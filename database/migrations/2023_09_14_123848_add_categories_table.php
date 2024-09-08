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
        $config = Config::get('softswiss.providers.category');
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
                ->comment('Category title');

            $table->string('slug')
                ->unique()
                ->comment('Category slug');

            $table->text('description')
                ->nullable()
                ->comment('Category description');

            $table->boolean('is_enabled')
                ->default(true)
                ->comment('Category is enabled');

            $table->integer('position')
                ->nullable()
                ->comment('Category position');

            $table->string('parent_id')
                ->nullable()
                ->comment('Category parent id');
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
