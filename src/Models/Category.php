<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Config;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $description
 * @property bool $is_enabled
 * @property string $image_url
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection|Game[] $games
 * @method Builder|Category static whereEnabled
 * @property string $slug Category slug
 * @property int|null $position
 * @property-read int|null $games_count
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereDescription($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereImageUrl($value)
 * @method static Builder|Category whereIsEnabled($value)
 * @method static Builder|Category whereName($value)
 * @method static Builder|Category whereOrder($value)
 * @method static Builder|Category whereSlug($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @method static Builder whereEnabled()
 */
class Category extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getConnectionName()
    {
        return Config::get('softswiss.providers.category.connection');
    }

    public function getTable()
    {
        return Config::get('softswiss.providers.category.table_name');
    }

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class);
    }
}
