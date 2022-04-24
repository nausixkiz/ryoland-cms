<?php

namespace App\Models\SubscriptionAndPlan;

use App\Services\Period;
use App\Traits\BelongsToPlan;
use App\Traits\ValidatingTrait;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use LogicException;

/**
 * App\Models\SubscriptionAndPlan\PlanSubscription.
 *
 * @property int $id
 * @property int $subscriber_id
 * @property string $subscriber_type
 * @property int $plan_id
 * @property string $slug
 * @property array $title
 * @property array $description
 * @property Carbon|null $trial_ends_at
 * @property Carbon|null $starts_at
 * @property Carbon|null $ends_at
 * @property Carbon|null $cancels_at
 * @property Carbon|null $canceled_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Plan $plan
 * @property-read Collection|PlanSubscriptionUsage[] $usage
 * @property-read Model|Eloquent $subscriber
 *
 * @method static Builder|PlanSubscription byPlanId($planId)
 * @method static Builder|PlanSubscription findEndedPeriod()
 * @method static Builder|PlanSubscription findEndedTrial()
 * @method static Builder|PlanSubscription findEndingPeriod($dayRange = 3)
 * @method static Builder|PlanSubscription findEndingTrial($dayRange = 3)
 * @method static Builder|PlanSubscription ofSubscriber(Model $subscriber)
 * @method static Builder|PlanSubscription whereCanceledAt($value)
 * @method static Builder|PlanSubscription whereCancelsAt($value)
 * @method static Builder|PlanSubscription whereCreatedAt($value)
 * @method static Builder|PlanSubscription whereDeletedAt($value)
 * @method static Builder|PlanSubscription whereDescription($value)
 * @method static Builder|PlanSubscription whereEndsAt($value)
 * @method static Builder|PlanSubscription whereId($value)
 * @method static Builder|PlanSubscription whereTitle($value)
 * @method static Builder|PlanSubscription wherePlanId($value)
 * @method static Builder|PlanSubscription whereSlug($value)
 * @method static Builder|PlanSubscription whereStartsAt($value)
 * @method static Builder|PlanSubscription whereTrialEndsAt($value)
 * @method static Builder|PlanSubscription whereUpdatedAt($value)
 * @method static Builder|PlanSubscription whereSubscriberId($value)
 * @method static Builder|PlanSubscription whereSubscriberType($value)
 */
class PlanSubscription extends Model
{
    use HasFactory;
    use SoftDeletes;
    use BelongsToPlan;
    use Sluggable;
    use SluggableScopeHelpers;
    use ValidatingTrait;


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
     * {@inheritdoc}
     */
    protected $fillable = [
        'subscriber_id',
        'subscriber_type',
        'plan_id',
        'slug',
        'name',
        'description',
        'trial_ends_at',
        'starts_at',
        'ends_at',
        'cancels_at',
        'canceled_at',
    ];
    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'subscriber_id' => 'integer',
        'subscriber_type' => 'string',
        'plan_id' => 'integer',
        'slug' => 'string',
        'trial_ends_at' => 'datetime',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'cancels_at' => 'datetime',
        'canceled_at' => 'datetime',
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

        static::validating(function (self $model) {
            if (!$model->starts_at || !$model->ends_at) {
                $model->setNewPeriod();
            }
        });

        static::deleted(function ($subscription) {
            $subscription->usage()->delete();
        });
    }

    /**
     * Set new subscription period.
     *
     * @param string $invoice_interval
     * @param int $invoice_period
     * @param string $start
     *
     * @return $this
     */
    protected function setNewPeriod($invoice_interval = '', $invoice_period = '', $start = '')
    {
        if (empty($invoice_interval)) {
            $invoice_interval = $this->plan->invoice_interval;
        }

        if (empty($invoice_period)) {
            $invoice_period = $this->plan->invoice_period;
        }

        $period = new Period($invoice_interval, $invoice_period, $start);

        $this->starts_at = $period->getStartDate();
        $this->ends_at = $period->getEndDate();

        return $this;
    }

    /**
     * The subscription may have many usage.
     *
     * @return HasMany
     */
    public function usage(): hasMany
    {
        return $this->hasMany(PlanSubscriptionUsage::class, 'subscription_id', 'id');
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
     * Get the owning subscriber.
     *
     * @return MorphTo
     */
    public function subscriber(): MorphTo
    {
        return $this->morphTo('subscriber', 'subscriber_type', 'subscriber_id', 'id');
    }

    /**
     * Check if subscription is inactive.
     *
     * @return bool
     */
    public function inactive(): bool
    {
        return !$this->active();
    }

    /**
     * Check if subscription is active.
     *
     * @return bool
     */
    public function active(): bool
    {
        return !$this->ended() || $this->onTrial();
    }

    /**
     * Check if subscription period has ended.
     *
     * @return bool
     */
    public function ended(): bool
    {
        return $this->ends_at ? Carbon::now()->gte($this->ends_at) : false;
    }

    /**
     * Check if subscription is currently on trial.
     *
     * @return bool
     */
    public function onTrial(): bool
    {
        return $this->trial_ends_at ? Carbon::now()->lt($this->trial_ends_at) : false;
    }

    /**
     * Cancel subscription.
     *
     * @param bool $immediately
     *
     * @return $this
     */
    public function cancel($immediately = false)
    {
        $this->canceled_at = Carbon::now();

        if ($immediately) {
            $this->ends_at = $this->canceled_at;
        }

        $this->save();

        return $this;
    }

    /**
     * Change subscription plan.
     *
     * @param Plan $plan
     *
     * @return $this
     */
    public function changePlan(Plan $plan)
    {
        // If plans does not have the same billing frequency
        // (e.g., invoice_interval and invoice_period) we will update
        // the billing dates starting today, and sice we are basically creating
        // a new billing cycle, the usage data will be cleared.
        if ($this->plan->invoice_interval !== $plan->invoice_interval || $this->plan->invoice_period !== $plan->invoice_period) {
            $this->setNewPeriod($plan->invoice_interval, $plan->invoice_period);
            $this->usage()->delete();
        }

        // Attach new plan to subscription
        $this->plan_id = $plan->getKey();
        $this->save();

        return $this;
    }

    /**
     * Renew subscription period.
     *
     * @return $this
     * @throws LogicException
     *
     */
    public function renew()
    {
        if ($this->ended() && $this->canceled()) {
            throw new LogicException('Unable to renew canceled ended subscription.');
        }

        $subscription = $this;

        DB::transaction(function () use ($subscription) {
            // Clear usage data
            $subscription->usage()->delete();

            // Renew period
            $subscription->setNewPeriod();
            $subscription->canceled_at = null;
            $subscription->save();
        });

        return $this;
    }

    /**
     * Check if subscription is canceled.
     *
     * @return bool
     */
    public function canceled(): bool
    {
        return $this->canceled_at ? Carbon::now()->gte($this->canceled_at) : false;
    }

    /**
     * Get bookings of the given subscriber.
     *
     * @param Builder $builder
     * @param Model $subscriber
     *
     * @return Builder
     */
    public function scopeOfSubscriber(Builder $builder, Model $subscriber): Builder
    {
        return $builder->where('subscriber_type', $subscriber->getMorphClass())->where('subscriber_id', $subscriber->getKey());
    }

    /**
     * Scope subscriptions with ending trial.
     *
     * @param Builder $builder
     * @param int $dayRange
     *
     * @return Builder
     */
    public function scopeFindEndingTrial(Builder $builder, int $dayRange = 3): Builder
    {
        $from = Carbon::now();
        $to = Carbon::now()->addDays($dayRange);

        return $builder->whereBetween('trial_ends_at', [$from, $to]);
    }

    /**
     * Scope subscriptions with ended trial.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function scopeFindEndedTrial(Builder $builder): Builder
    {
        return $builder->where('trial_ends_at', '<=', now());
    }

    /**
     * Scope subscriptions with ending periods.
     *
     * @param Builder $builder
     * @param int $dayRange
     *
     * @return Builder
     */
    public function scopeFindEndingPeriod(Builder $builder, int $dayRange = 3): Builder
    {
        $from = Carbon::now();
        $to = Carbon::now()->addDays($dayRange);

        return $builder->whereBetween('ends_at', [$from, $to]);
    }

    /**
     * Scope subscriptions with ended periods.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function scopeFindEndedPeriod(Builder $builder): Builder
    {
        return $builder->where('ends_at', '<=', now());
    }

    /**
     * Scope all active subscriptions for a user.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function scopeFindActive(Builder $builder): Builder
    {
        return $builder->where('ends_at', '>', now());
    }

    /**
     * Record feature usage.
     *
     * @param string $featureSlug
     * @param int $uses
     *
     * @return PlanSubscriptionUsage
     */
    public function recordFeatureUsage(string $featureSlug, int $uses = 1, bool $incremental = true): PlanSubscriptionUsage
    {
        $feature = $this->plan->features()->where('slug', $featureSlug)->first();

        $usage = $this->usage()->firstOrNew([
            'subscription_id' => $this->getKey(),
            'feature_id' => $feature->getKey(),
        ]);

        if ($feature->resettable_period) {
            // Set expiration date when the usage record is new or doesn't have one.
            if (is_null($usage->valid_until)) {
                // Set date from subscription creation date so the reset
                // period match the period specified by the subscription's plan.
                $usage->valid_until = $feature->getResetDate($this->created_at);
            } elseif ($usage->expired()) {
                // If the usage record has been expired, let's assign
                // a new expiration date and reset the uses to zero.
                $usage->valid_until = $feature->getResetDate($usage->valid_until);
                $usage->used = 0;
            }
        }

        $usage->used = ($incremental ? $usage->used + $uses : $uses);

        $usage->save();

        return $usage;
    }

    /**
     * Reduce usage.
     *
     * @param string $featureSlug
     * @param int $uses
     *
     * @return PlanSubscriptionUsage|null
     */
    public function reduceFeatureUsage(string $featureSlug, int $uses = 1): ?PlanSubscriptionUsage
    {
        $usage = $this->usage()->byFeatureSlug($featureSlug)->first();

        if (is_null($usage)) {
            return null;
        }

        $usage->used = max($usage->used - $uses, 0);

        $usage->save();

        return $usage;
    }

    /**
     * Determine if the feature can be used.
     *
     * @param string $featureSlug
     *
     * @return bool
     */
    public function canUseFeature(string $featureSlug): bool
    {
        $featureValue = $this->getFeatureValue($featureSlug);
        $usage = $this->usage()->byFeatureSlug($featureSlug)->first();

        if ($featureValue === 'true') {
            return true;
        }

        // If the feature value is zero, let's return false since
        // there's no uses available. (useful to disable countable features)
        if (!$usage || $usage->expired() || is_null($featureValue) || $featureValue === '0' || $featureValue === 'false') {
            return false;
        }

        // Check for available uses
        return $this->getFeatureRemainings($featureSlug) > 0;
    }

    /**
     * Get feature value.
     *
     * @param string $featureSlug
     *
     * @return mixed
     */
    public function getFeatureValue(string $featureSlug)
    {
        $feature = $this->plan->features()->where('slug', $featureSlug)->first();

        return $feature->value ?? null;
    }

    /**
     * Get the available uses.
     *
     * @param string $featureSlug
     *
     * @return int
     */
    public function getFeatureRemainings(string $featureSlug): int
    {
        return $this->getFeatureValue($featureSlug) - $this->getFeatureUsage($featureSlug);
    }

    /**
     * Get how many times the feature has been used.
     *
     * @param string $featureSlug
     *
     * @return int
     */
    public function getFeatureUsage(string $featureSlug): int
    {
        $usage = $this->usage()->byFeatureSlug($featureSlug)->first();

        return (!$usage || $usage->expired()) ? 0 : $usage->used;
    }
}
