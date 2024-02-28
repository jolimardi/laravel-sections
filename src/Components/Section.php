<?php

namespace JoliMardi\MySections\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Section extends Component {

    public function __construct() {
    }

    public function render(): View|Closure|string {

        // Si la view views/components/section.blade.php existe, on la prend en priorité
        if (view()->exists('components.section')) {
            return view('components.section');
        }

        // Puis si la view views/vendor/laravel-sections/components/section.blade.php existe, on la prend ensuite (celle qui est copiée si on publie les vues du module)
        if (view()->exists('vendor.laravel-sections.components.section')) {
            return view('vendor.laravel-sections.components.section');
        }

        return view('section::components.section');
    }
}
