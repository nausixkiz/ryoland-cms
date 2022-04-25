<?php

namespace App\Traits;

use App\Models\SubscriptionAndPlan\PlanSubscription;
use App\Models\SubscriptionAndPlan\Plan;
use App\Services\Period;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasPlanSubscriptions
{
    /**
     * Boot the HasPlanSubscriptions trait for the model.
     *
     * @return void
     */
    protected static function bootHasSubscriptions()
    {
        static::deleted(function ($plan) {
            $plan->planSubscriptions()->delete();
        });
    }

    /**
     * The subscriber may have many plan subscriptions.
     *
     * @return MorphMany
     */
    public function planSubscriptions(): MorphMany
    {
        return $this->morphMany(PlanSubscription::class, 'subscriber', 'subscriber_type', 'subscriber_id');
    }

    /**
     * Define a polymorphic one-to-many relationship.
     *
     * @param string $related
     * @param string $name
     * @param string $type
     * @param string $id
     * @param string $localKey
     *
     * @return MorphMany
     */
    abstract public function morphMany($related, $name, $type = null, $id = null, $localKey = null);

    /**
     * A model may have many active plan subscriptions.
     *
     * @return Collection
     */
    public function activePlanSubscriptions(): Collection
    {
        return $this->planSubscriptions->reject->inactive();
    }

    /**
     * Get a plan subscription by slug.
     *
     * @param string $subscriptionSlug
     *
     * @return PlanSubscription|null
     */
    public function planSubscription(string $subscriptionSlug): ?PlanSubscription
    {
        return $this->planSubscriptions()->where('slug', $subscriptionSlug)->first();
    }

    /**
     * Get subscribed plans.
     *
     * @return Collection
     */
    public function subscribedPlans(): Collection
    {
        $planIds = $this->planSubscriptions->reject->inactive()->pluck('plan_id')->unique();

        return app('rinvex.subscriptions.plan')->whereIn('id', $planIds)->get();
    }

    /**
     * Check if the subscriber subscribed to the given plan.
     *
     * @param int $planId
     *
     * @return bool
     */
    public function subscribedTo(int $planId): bool
    {
        $subscription = $this->planSubscriptions()->where('plan_id', $planId)->first();

        return $subscription && $subscription->active();
    }

    /**
     * Check if the subscriber subscribed to the given plan.
     *
     * @param int $planId
     *
     * @return bool
     */
    public function subscribedToOneOfTheSubscription() : bool
    {
        $subscription = $this->planSubscriptions()->whereIn('plan_id', Plan::all()->pluck('id'))->first();

        if(!$subscription) {
            return false;
        }

        return $subscription && $subscription->active();
    }

    /**
     * Subscribe subscriber to a new plan.
     *
     * @param string $subscription
     * @param Plan $plan
     * @param Carbon|null $startDate
     *
     * @return PlanSubscription
     */
    public function newPlanSubscription($subscription, Plan $plan, Carbon $startDate = null): PlanSubscription
    {
        $trial = new Period($plan->trial_interval, $plan->trial_period, $startDate ?? now());
        $period = new Period($plan->invoice_interval, $plan->invoice_period, $trial->getEndDate());

        return $this->planSubscriptions()->create([
            'name' => $subscription,
            'plan_id' => $plan->getKey(),
            'trial_ends_at' => $trial->getEndDate(),
            'starts_at' => $period->getStartDate(),
            'ends_at' => $period->getEndDate(),
        ]);
    }
}
