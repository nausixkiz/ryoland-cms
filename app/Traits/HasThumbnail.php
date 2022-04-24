<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

trait HasThumbnail
{
    public function getThumbnailUrl(): ?string
    {
        if ($this->hasThumbnail()) {
            return $this->getFirstMedia('thumbnail')->getTemporaryUrl(Carbon::now()->addMinutes(5));
        }

        return null;
    }

    public function getThumbnailConversionUrl(): ?string
    {
        if ($this->hasMedia('thumbnail')) {
            return $this->getFirstMedia('thumbnail')->getTemporaryUrl(Carbon::now()->addMinutes(5), 'thumbnail');
        }

        return null;
    }

    public function hasThumbnail(): bool
    {
        return $this->hasMedia('thumbnail');
    }
}
