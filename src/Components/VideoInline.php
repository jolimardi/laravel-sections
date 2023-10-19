<?php

namespace JoliMardi\MySections\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VideoInline extends Component {

    public $video;

    public function __construct($video) {
        $this->video = $video;
    }

    public function render(): View|Closure|string {

        if (view()->exists('vendor.laravel-sections.components.video-inline')) {
            return view('vendor.laravel-sections.components.video-inline');
        }

        return view('section::components.video-inline');
    }
}
