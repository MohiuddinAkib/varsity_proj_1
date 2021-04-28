<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class Modal extends Component
{
    /**
     * @var bool
     */
    public $open;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(bool $open)
    {
        $this->open = $open;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.modal.modal');
    }
}
