<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class NeverExpiredOptionComponent extends Component
{
    public bool $isChecked;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($isChecked)
    {
        $this->isChecked = $isChecked == 'true';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.never-expired-option-component');
    }
}
