<?php

namespace App\Traits;

use App\Constants\StatusConst;

trait HasStatus
{
    public function isPublished(): bool
    {
        return $this->status == StatusConst::PUBLISHED;
    }

    public function getPublishedString(): string
    {
        return StatusConst::PUBLISHED;
    }

    public function isDraft(): bool
    {
        return $this->status == StatusConst::DRAFT;
    }

    public function getDraftString(): string
    {
        return StatusConst::DRAFT;
    }

    public function isPending(): bool
    {
        return $this->status == StatusConst::PENDING;
    }

    public function getPendingString(): string
    {
        return StatusConst::PENDING;
    }
}
