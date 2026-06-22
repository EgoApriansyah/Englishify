<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class TestLayout extends Component
{
    public $timeLeft;

    /**
     * Create a new component instance.
     */
    public function __construct($timeLeft = 0)
    {
        $this->timeLeft = $timeLeft;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.test');
    }
}
