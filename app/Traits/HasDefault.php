<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

trait HasDefault
{
    /**
     * Find a model by its primary slug.
     *
     * @param bool $isDefault
     * @param array $columns
     * @return Collection
     */
    public static function getAllDefault(bool $isDefault = true, array $columns = ['*']): Collection
    {
        return static::default($isDefault)->get($columns);
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->is_default === 1;
    }

    /**
     * Scope a query to get featured item from the current model.
     *
     * @param Builder $query
     * @param bool $isDefault
     * @return Builder
     */
    public function scopeDefault(Builder $query, bool $isDefault = true)
    {
        return $query->where($this->getFeaturedKeyName(), $isDefault);
    }

    public function getFeaturedKeyName(): string
    {
        return 'is_default';
    }
}
