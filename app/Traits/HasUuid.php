<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use function Illuminate\Events\queueable;

trait HasUuid
{
    /**
     * Boot functions from Laravel.
     */
    protected static function bootHasUuid()
    {
        static::creating(function (Model $model) {
            $model->primaryKey = 'uuid';
            $model->keyType = 'string';
            $model->incrementing = false;

            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing(): bool
    {
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType(): string
    {
        return 'string';
    }
}
