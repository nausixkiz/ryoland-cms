<?php

namespace App\Models;

use App\Traits\HasFeatured;
use App\Traits\HasStatus;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers;
    use HasStatus;
    use HasFeatured;

    protected $fillable = ['name', 'description', 'icon', 'is_featured', 'is_default', 'status'];

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function blogs() : HasMany
    {
        return $this->hasMany(Blog::class);
    }

    public function default(): bool
    {
        return $this->is_default === 1;
    }
}
