<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait HasGallery
{
    public function getGalleryUrl()
    {
        if ($this->hasGallery()) {
            return $this->getMedia('gallery')->map(fn(Media $media) => $media->getTemporaryUrl(Carbon::now()->addMinutes(5)));
        }

        return null;
    }

    public function getGalleryConversionUrl()
    {
        if ($this->hasMedia('gallery')) {
            return $this->getMedia('gallery')->map(fn(Media $media) => $media->getTemporaryUrl(Carbon::now()->addMinutes(5), 'gallery'));
        }

        return null;
    }

    public function hasGallery(): bool
    {
        return $this->hasMedia('gallery');
    }
}
