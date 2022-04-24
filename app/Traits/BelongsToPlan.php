<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToPlan
{
    /**
     * The model always belongs to a plan.
     *
     * @return BelongsTo
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id', 'plan');
    }

    /**
     * Scope models by plan id.
     *
     * @param Builder $builder
     * @param int $planId
     *
     * @return Builder
     */
    public function scopeByPlanId(Builder $builder, int $planId): Builder
    {
        return $builder->where('plan_id', $planId);
    }
}
