<?php

namespace App\Traits;

use App\Constants\RealEstateStatus;

trait HasRealEstateStatus
{

    public function renderRealEstateBadgeHtml(): string
    {
        $html = '<span class="badge rounded-pill text-capitalized';

        if ($this->isNotAvailable()) {
            $html .= ' badge-light-danger';
        } elseif ($this->isPreparingForSelling()) {
            $html .= ' badge-light-warning';
        } elseif ($this->isSelling()) {
            $html .= ' badge-light-success';
        } elseif ($this->isSold()) {
            $html .= ' badge-light-secondary';
        } elseif ($this->isBuilding()) {
            $html .= ' badge-light-info';
        } else if ($this->isRenting()) {
            $html .= ' badge-light-primary';
        } else if ($this->isRented()) {
            $html .= ' badge-light-dark';
        }

        $html .= '">';
        $html .= ucwords($this->status);
        $html .= '</span>';

        return $html;
    }

    public function isNotAvailable(): bool
    {
        return $this->status == RealEstateStatus::NOT_AVAILABLE;
    }

    public function isPreparingForSelling(): bool
    {
        return $this->status == RealEstateStatus::PREPARING_FOR_SELLING;
    }

    public function isSelling(): bool
    {
        return $this->status == RealEstateStatus::SELLING;
    }

    public function isSold(): bool
    {
        return $this->status == RealEstateStatus::SOLD;
    }

    public function isBuilding(): bool
    {
        return $this->status == RealEstateStatus::BUILDING;
    }

    public function isRenting(): bool
    {
        return $this->status == RealEstateStatus::RENTING;
    }

    public function isRented(): bool
    {
        return $this->status == RealEstateStatus::RENTED;
    }
}
