<?php

namespace App\Models\SubscriptionAndPlan;

use App\Services\Period;
use App\Traits\BelongsToPlan;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * App\Models\PlanFeature.
 *
 * @property int $id
 * @property int $plan_id
 * @property string $slug
 * @property array $title
 * @property array $description
 * @property string $value
 * @property int $resettable_period
 * @property string $resettable_interval
 * @property int $sort_order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Plan $plan
 * @property-read Collection|PlanSubscriptionUsage[] $usage
 *
 * @method static Builder|PlanFeature byPlanId($planId)
 * @method static Builder|PlanFeature ordered($direction = 'asc')
 * @method static Builder|PlanFeature whereCreatedAt($value)
 * @method static Builder|PlanFeature whereDeletedAt($value)
 * @method static Builder|PlanFeature whereDescription($value)
 * @method static Builder|PlanFeature whereId($value)
 * @method static Builder|PlanFeature whereTitle($value)
 * @method static Builder|PlanFeature wherePlanId($value)
 * @method static Builder|PlanFeature whereResettableInterval($value)
 * @method static Builder|PlanFeature whereResettablePeriod($value)
 * @method static Builder|PlanFeature whereSlug($value)
 * @method static Builder|PlanFeature whereSortOrder($value)
 * @method static Builder|PlanFeature whereUpdatedAt($value)
 * @method static Builder|PlanFeature whereValue($value)
 */
class PlanFeature extends Model implements Sortable
{
    use Sluggable;
    use HasFactory;
    use SoftDeletes;
    use BelongsToPlan;
    use SortableTrait;
    use SluggableScopeHelpers;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatable = [
        'name',
        'description',
    ];
    /**
     * The sortable settings.
     *
     * @var array
     */
    public $sortable = [
        'order_column_name' => 'sort_order',
    ];
    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'plan_id',
        'slug',
        'name',
        'description',
        'value',
        'resettable_period',
        'resettable_interval',
        'sort_order',
    ];
    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'plan_id' => 'integer',
        'slug' => 'string',
        'value' => 'string',
        'resettable_period' => 'integer',
        'resettable_interval' => 'string',
        'sort_order' => 'integer',
        'deleted_at' => 'datetime',
    ];
    /**
     * {@inheritdoc}
     */
    protected $observables = [
        'validating',
        'validated',
    ];
    /**
     * The default rules that the model will validate against.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Whether the model should throw a
     * ValidationException if it fails validation.
     *
     * @var bool
     */
    protected $throwValidationExceptions = true;

    /**
     * {@inheritdoc}
     */
    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($plan_feature) {
            $plan_feature->usage()->delete();
        });
    }

    /**
     * The plan feature may have many subscription usage.
     *
     * @return HasMany
     */
    public function usage(): HasMany
    {
        return $this->hasMany(PlanSubscriptionUsage::class, 'feature_id', 'id');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get feature's reset date.
     *
     * @param Carbon $dateFrom
     *
     * @return Carbon
     */
    public function getResetDate(Carbon $dateFrom): Carbon
    {
        $period = new Period($this->resettable_interval, $this->resettable_period, $dateFrom ?? now());

        return $period->getEndDate();
    }
}
