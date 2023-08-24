<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Config;

/**
 * App\Models\Game
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property bool $is_enabled
 * @property string $identifier
 * @property int $provider_id
 * @property int $vendor_id
 * @property string $producer
 * @property string $feature_group
 * @property array $devices
 * @property bool $has_freespins
 * @property string $payout
 * @property int $lines
 * @property bool $hd
 * @property string $image_url
 * @property Carbon $released_at
 * @property Carbon $recalled_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $url
 * @property string $demo_url
 * @property bool $is_new
 * @property bool $is_favored
 * @property bool $is_tournament
 * @property bool $has_demo
 * @property bool $tournaments_count
 * @property bool $people_count
 * @property int|null $position
 * @property-read Collection|Category[] $categories
 * @property-read Provider $provider
 * @property array|null $country_restriction Restricted countries
 * @method static Builder|Game newModelQuery()
 * @method static Builder|Game newQuery()
 * @method static Builder|Game query()
 * @method static Builder|Game whereCountryRestriction($value)
 * @method static Builder|Game whereCreatedAt($value)
 * @method static Builder|Game whereDevices($value)
 * @method static Builder|Game whereFeatureGroup($value)
 * @method static Builder|Game whereHasFreespins($value)
 * @method static Builder|Game whereHd($value)
 * @method static Builder|Game whereId($value)
 * @method static Builder|Game whereIdentifier($value)
 * @method static Builder|Game whereImageUrl($value)
 * @method static Builder|Game whereIsEnabled($value)
 * @method static Builder|Game whereLines($value)
 * @method static Builder|Game whereOrder($value)
 * @method static Builder|Game wherePayout($value)
 * @method static Builder|Game whereProducer($value)
 * @method static Builder|Game whereProviderId($value)
 * @method static Builder|Game whereRecalledAt($value)
 * @method static Builder|Game whereReleasedAt($value)
 * @method static Builder|Game whereSlug($value)
 * @method static Builder|Game whereTitle($value)
 * @method static Builder|Game whereUpdatedAt($value)
 *
 * @mixin Eloquent\Model
 */
class Game extends Model
{
    use HasFactory;

    protected $guarded = false;

    /**
     * @var string[]
     */
    protected $casts = [
        'devices' => AsArrayObject::class,
        'country_restriction' => AsArrayObject::class,
        'currencies' => AsArrayObject::class,
    ];

    public function getConnectionName()
    {
        return Config::get('softswiss.providers.game.connection');
    }

    public function getTable()
    {
        return Config::get('softswiss.providers.game.table_name');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }
}
