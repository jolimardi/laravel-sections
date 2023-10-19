<?php

namespace JoliMardi\MySections\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VideoPopup extends Component {

    public $video;

    public function __construct($video) {
        $this->video = $video;
    }

    public function render(): View|Closure|string {

        if (view()->exists('vendor.laravel-sections.components.video-popup')) {
            return view('vendor.laravel-sections.components.video-popup');
        }

        return view('section::components.video-popup');
    }
}
