<?php

namespace JoliMardi\MySections\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class YoutubeInline extends Component {

    public function __construct() {
    }

    public function render(): View|Closure|string {

        if (view()->exists('vendor.laravel-sections.components.youtube-inline')) {
            return view('vendor.laravel-sections.components.youtube-inline');
        }

        return view('section::components.youtube-inline');
    }
}
