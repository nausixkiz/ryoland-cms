<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

trait HasThumbnail
{
    public function getThumbnailUrl()
    {
        if ($this->hasMedia('thumbnail')) {
            return $this->getFirstMedia('thumbnail')->getTemporaryUrl(Carbon::now()->addMinutes(5));
        }

        return null;
    }

    public function getTemporaryUrl(string $fullFilePath, int $numberOfMinutes, string $disk)
    {
        return Storage::disk($disk)->temporaryUrl($fullFilePath, now()->addMinutes($numberOfMinutes));
    }

    public function hasThumbnail()
    {
        return $this->hasMedia('thumbnail');
    }
}
