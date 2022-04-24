<?php

namespace App\Models\RealEstate;

use App\Models\User;
use App\Traits\HasFeatured;
use App\Traits\HasGallery;
use App\Traits\HasRealEstateStatus;
use App\Traits\HasThumbnail;
use Conner\Tagging\Taggable;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Property extends Model implements HasMedia, Viewable
{
    use HasFactory;
    use InteractsWithMedia;
    use Taggable;
    use Sluggable;
    use InteractsWithViews;
    use SluggableScopeHelpers;
    use HasRealEstateStatus;
    use HasThumbnail;
    use HasFeatured;
    use HasGallery;

    protected $table = 'r_e_properties';

    protected $fillable = [
        'name',
        'contents',
        'location',
        'number_bedroom',
        'number_bathroom',
        'number_floor',
        'square',
        'price',
        'type',
        'description',
        'period',
        'moderation_status',
        'expire_date',
        'latitude',
        'longitude',
        'auto_renew',
        'never_expired',
        'is_featured',
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


    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->fit(Manipulations::FIT_STRETCH, 850, 650)
            ->performOnCollections('thumbnail');

        $this->addMediaConversion('gallery')
            ->fit(Manipulations::FIT_STRETCH, 1904, 1006)
            ->performOnCollections('gallery');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'r_e_property_category', 'property_id', 'category_id');
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'r_e_property_feature', 'property_id', 'feature_id');
    }

    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'r_e_property_facility', 'property_id', 'facility_id')->withPivot('distance');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(Investor::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function isNeverExpired(): bool
    {
        return $this->never_expired === 1;
    }

    public function forRent()
    {
        return $this->where('type', 'rent')->get();
    }

    public function isForRent()
    {
        return $this->type === 'rent';
    }
}
