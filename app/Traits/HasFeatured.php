<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

trait HasFeatured
{
    /**
     * Find a model by its primary slug.
     *
     * @param bool $isFeatured
     * @param array $columns
     * @return Collection
     */
    public static function getAllFeatured(bool $isFeatured = true, array $columns = ['*']): Collection
    {
        return (new \App\Models\RealEstate\Property)->featured($isFeatured)->get($columns);
    }

    /**
     * @return bool
     */
    public function isFeatured(): bool
    {
        return $this->is_featured === 1;
    }

    /**
     * Scope a query to get featured item from the current model.
     *
     * @param Builder $query
     * @param bool $isFeatured
     * @return Builder
     */
    public function scopeFeatured(Builder $query, bool $isFeatured = true)
    {
        return $query->where($this->getFeaturedKeyName(), $isFeatured);
    }

    public function getFeaturedKeyName(): string
    {
        return 'is_featured';
    }
}
