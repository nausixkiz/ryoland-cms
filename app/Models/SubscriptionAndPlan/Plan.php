<?php

namespace App\Models\SubscriptionAndPlan;

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
 * App\Models\Plan.
 *
 * @property int $id
 * @property string $slug
 * @property array $name
 * @property array $description
 * @property bool $is_active
 * @property float $price
 * @property float $signup_fee
 * @property string $currency
 * @property int $trial_period
 * @property string $trial_interval
 * @property int $invoice_period
 * @property string $invoice_interval
 * @property int $grace_period
 * @property string $grace_interval
 * @property int $prorate_day
 * @property int $prorate_period
 * @property int $prorate_extend_due
 * @property int $active_subscribers_limit
 * @property int $sort_order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|PlanFeature[] $features
 * @property-read Collection|PlanSubscription[] $subscriptions
 *
 * @method static Builder|Plan ordered($direction = 'asc')
 * @method static Builder|Plan whereActiveSubscribersLimit($value)
 * @method static Builder|Plan whereCreatedAt($value)
 * @method static Builder|Plan whereCurrency($value)
 * @method static Builder|Plan whereDeletedAt($value)
 * @method static Builder|Plan whereDescription($value)
 * @method static Builder|Plan whereGraceInterval($value)
 * @method static Builder|Plan whereGracePeriod($value)
 * @method static Builder|Plan whereId($value)
 * @method static Builder|Plan whereInvoiceInterval($value)
 * @method static Builder|Plan whereInvoicePeriod($value)
 * @method static Builder|Plan whereIsActive($value)
 * @method static Builder|Plan whereName($value)
 * @method static Builder|Plan wherePrice($value)
 * @method static Builder|Plan whereProrateDay($value)
 * @method static Builder|Plan whereProrateExtendDue($value)
 * @method static Builder|Plan whereProratePeriod($value)
 * @method static Builder|Plan whereSignupFee($value)
 * @method static Builder|Plan whereSlug($value)
 * @method static Builder|Plan whereSortOrder($value)
 * @method static Builder|Plan whereTrialInterval($value)
 * @method static Builder|Plan whereTrialPeriod($value)
 * @method static Builder|Plan whereUpdatedAt($value)
 */
class Plan extends Model implements Sortable
{
    use Sluggable;
    use HasFactory;
    use SoftDeletes;
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
        'slug',
        'name',
        'description',
        'is_active',
        'price',
        'signup_fee',
        'currency',
        'trial_period',
        'trial_interval',
        'invoice_period',
        'invoice_interval',
        'grace_period',
        'grace_interval',
        'prorate_day',
        'prorate_period',
        'prorate_extend_due',
        'active_subscribers_limit',
        'sort_order',
    ];
    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'slug' => 'string',
        'is_active' => 'boolean',
        'price' => 'float',
        'signup_fee' => 'float',
        'currency' => 'string',
        'trial_period' => 'integer',
        'trial_interval' => 'string',
        'invoice_period' => 'integer',
        'invoice_interval' => 'string',
        'grace_period' => 'integer',
        'grace_interval' => 'string',
        'prorate_day' => 'integer',
        'prorate_period' => 'integer',
        'prorate_extend_due' => 'integer',
        'active_subscribers_limit' => 'integer',
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

        static::deleted(function ($plan) {
            $plan->features()->delete();
            $plan->planSubscriptions()->delete();
        });
    }

    /**
     * The plan may have many features.
     *
     * @return HasMany
     */
    public function features(): HasMany
    {
        return $this->hasMany(PlanFeature::class, 'plan_id', 'id');
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
     * The plan may have many subscriptions.
     *
     * @return HasMany
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(PlanSubscription::class, 'plan_id', 'id');
    }

    /**
     * Check if plan is free.
     *
     * @return bool
     */
    public function isFree(): bool
    {
        return (float)$this->price <= 0.00;
    }

    /**
     * Check if plan has trial.
     *
     * @return bool
     */
    public function hasTrial(): bool
    {
        return $this->trial_period && $this->trial_interval;
    }

    /**
     * Check if plan has grace.
     *
     * @return bool
     */
    public function hasGrace(): bool
    {
        return $this->grace_period && $this->grace_interval;
    }

    /**
     * Get plan feature by the given slug.
     *
     * @param string $featureSlug
     *
     * @return PlanFeature|null
     */
    public function getFeatureBySlug(string $featureSlug): ?PlanFeature
    {
        return $this->features()->where('slug', $featureSlug)->first();
    }

    /**
     * Activate the plan.
     *
     * @return $this
     */
    public function activate()
    {
        $this->update(['is_active' => true]);

        return $this;
    }

    /**
     * Deactivate the plan.
     *
     * @return $this
     */
    public function deactivate()
    {
        $this->update(['is_active' => false]);

        return $this;
    }
}
