<?php

namespace App\View\Components\Filter;

use App\Constants\RealEstateStatus;
use App\Constants\StatusConst;
use Illuminate\View\Component;

class SelectStatusComponent extends Component
{
    public array $listStatus;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        $this->listStatus = match ($type) {
            'normal' => StatusConst::getAllListStatus(),
            'real-estate' => RealEstateStatus::getAllListRealEstateStatus(),
        };
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.filter.select-status-component');
    }
}
