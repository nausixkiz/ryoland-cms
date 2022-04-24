<?php

namespace App\Models;

use App\Traits\HasStatus;
use App\Traits\HasThumbnail;
use Conner\Tagging\Taggable;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia, Viewable
{
    use HasFactory;
    use InteractsWithMedia;
    use Taggable;
    use Sluggable;
    use InteractsWithViews;
    use SluggableScopeHelpers;
    use HasStatus;
    use HasThumbnail;

    protected $table = 'blogs';

    protected $fillable = [
        'name',
        'description',
        'contents',
        'slug',
        'status',
        'is_featured',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
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

    public function hasRelatedTags(): bool
    {
        return count($this->tagNames()) > 0;
    }

    public function getAllTags(): Collection
    {
        Collection::macro('toTagCollection', function () {
            return $this->map(function ($value) {
                return (object)[
                    'name' => $value->tag_name,
                    'slug' => $value->tag_slug
                ];
            });
        });
        return collect($this->tagged)->toTagCollection();
    }

    public function hasPreviousBlog(): bool
    {
        return $this->previousBlog() !== null;
    }

    public function previousBlog()
    {
        return $this->where('id', '<', $this->id)->orderBy('id', 'desc')->first();
    }

    public function hasNextBlog(): bool
    {
        return $this->nextBlog() !== null;
    }

    public function nextBlog()
    {
        return $this->where('id', '>', $this->id)->orderBy('id', 'desc')->first();
    }

    public function featured(): bool
    {
        return $this->is_featured === 1;
    }

}
