<?php

namespace App\Models\SubscriptionAndPlan;

use App\Traits\ValidatingTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PlanSubscriptionUsage.
 *
 * @property int $id
 * @property int $subscription_id
 * @property int $feature_id
 * @property int $used
 * @property Carbon|null $valid_until
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read PlanFeature $feature
 * @property-read PlanSubscription $subscription
 *
 * @method static Builder|PlanSubscriptionUsage byFeatureSlug($featureSlug)
 * @method static Builder|PlanSubscriptionUsage whereCreatedAt($value)
 * @method static Builder|PlanSubscriptionUsage whereDeletedAt($value)
 * @method static Builder|PlanSubscriptionUsage whereFeatureId($value)
 * @method static Builder|PlanSubscriptionUsage whereId($value)
 * @method static Builder|PlanSubscriptionUsage whereSubscriptionId($value)
 * @method static Builder|PlanSubscriptionUsage whereUpdatedAt($value)
 * @method static Builder|PlanSubscriptionUsage whereUsed($value)
 * @method static Builder|PlanSubscriptionUsage whereValidUntil($value)
 */
class PlanSubscriptionUsage extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ValidatingTrait;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'subscription_id',
        'feature_id',
        'used',
        'valid_until',
    ];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'subscription_id' => 'integer',
        'feature_id' => 'integer',
        'used' => 'integer',
        'valid_until' => 'datetime',
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
     * Subscription usage always belongs to a plan feature.
     *
     * @return BelongsTo
     */
    public function feature(): BelongsTo
    {
        return $this->belongsTo(config(PlanFeature::class), 'feature_id', 'id', 'feature');
    }

    /**
     * Subscription usage always belongs to a plan subscription.
     *
     * @return BelongsTo
     */
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(PlanSubscription::class, 'subscription_id', 'id', 'subscription');
    }

    /**
     * Scope subscription usage by feature slug.
     *
     * @param Builder $builder
     * @param string $featureSlug
     *
     * @return Builder
     */
    public function scopeByFeatureSlug(Builder $builder, string $featureSlug): Builder
    {
        $feature = $this->where('slug', $featureSlug)->first();

        return $builder->where('feature_id', $feature ? $feature->getKey() : null);
    }

    /**
     * Check whether usage has been expired or not.
     *
     * @return bool
     */
    public function expired(): bool
    {
        if (is_null($this->valid_until)) {
            return false;
        }

        return Carbon::now()->gte($this->valid_until);
    }
}
