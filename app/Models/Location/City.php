<?php

namespace App\Models\Location;

use App\Traits\HasDefault;
use App\Traits\HasFeatured;
use App\Traits\HasStatus;
use App\Traits\HasThumbnail;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class City extends Model implements HasMedia
{
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers;
    use HasStatus;
    use InteractsWithMedia;
    use HasThumbnail;
    use HasFeatured;
    use HasDefault;

    protected $fillable = [
        'name',
        'is_featured',
        'is_default',
        'status',
    ];

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

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
