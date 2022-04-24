<?php

namespace App\View\Components\Form;

use App\Constants\ModerationStatus;
use App\Constants\RealEstateStatus;
use App\Constants\StatusConst;
use Illuminate\View\Component;

class SelectStatusComponent extends Component
{
    public string $layoutStyle;
    public array $listStatus;
    public mixed $statusVal;
    public string $type;
    public string $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($layoutStyle, string $type, $statusVal = null)
    {
        $this->layoutStyle = $layoutStyle;
        $this->type = $type;
        $this->listStatus = match ($type) {
            'normal' => StatusConst::getAllListStatus(),
            'moderation-status' => ModerationStatus::getAllListModerationStatus(),
            'real-estate' => RealEstateStatus::getAllListRealEstateStatus(),
        };

        switch ($type){
            case 'moderation-status':
                $this->name = 'moderation_status';
                break;
            default:
                $this->name = 'status';
                break;
        }

        $this->statusVal = $statusVal;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.select-status-component');
    }

    /**
     * Determine if the given option is the currently selected option.
     *
     * @param  string  $option
     * @return bool
     */
    public function isSelected($option)
    {
        return $option === $this->selected;
    }
}
