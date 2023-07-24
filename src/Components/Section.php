<?php

namespace JoliMardi\MySections\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Section extends Component {
    public function __construct() {
    }
    public function render(): View|Closure|string {
        return view('section::components.section');
    }
}
