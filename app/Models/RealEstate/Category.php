<?php

namespace App\Models\RealEstate;

use App\Models\Blog;
use App\Traits\HasDefault;
use App\Traits\HasStatus;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers;
    use HasStatus;
    use HasDefault;

    protected $table = 'r_e_categories';

    protected $fillable = ['name', 'description', 'status', 'is_default', 'is_featured'];

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

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'r_e_property_category', 'category_id', 'property_id');
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'r_e_project_category', 'project_id', 'category_id');
    }

}
