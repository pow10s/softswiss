<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Config;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property bool $is_enabled
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection|Game[] $games
 * @method Builder|Provider static whereEnabled
 * @property int|null $position
 * @property array $accepted_currencies
 * @property array|null $country_restriction
 * @property-read int|null $games_count
 * @method static Builder|Provider newModelQuery()
 * @method static Builder|Provider newQuery()
 * @method static Builder|Provider query()
 * @method static Builder|Provider whereCreatedAt($value)
 * @method static Builder|Provider whereDescription($value)
 * @method static Builder|Provider whereId($value)
 * @method static Builder|Provider whereImageUrl($value)
 * @method static Builder|Provider whereIsEnabled($value)
 * @method static Builder|Provider whereName($value)
 * @method static Builder|Provider whereOrder($value)
 * @method static Builder|Provider whereSlug($value)
 * @method static Builder|Provider whereUpdatedAt($value)
 */
class Provider extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $casts = [
        'accepted_currencies' => AsArrayObject::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'country_restriction' => AsArrayObject::class,
    ];

    public function getConnectionName()
    {
        return Config::get('softswiss.providers.provider.connection');
    }

    public function getTable()
    {
        return Config::get('softswiss.providers.provider.table_name');
    }

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
