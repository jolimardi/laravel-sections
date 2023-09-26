<?php

namespace JoliMardi\MySections\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Youtube extends Component {

    public $youtube;

    public function __construct($youtube) {
        $this->youtube = $youtube;
    }

    public function render(): View|Closure|string {

        if (view()->exists('vendor.laravel-sections.components.youtube')) {
            return view('vendor.laravel-sections.components.youtube');
        }

        return view('section::components.youtube');
    }
}
