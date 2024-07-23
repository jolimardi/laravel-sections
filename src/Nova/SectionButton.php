<?php

namespace JoliMardi\MySections\Nova;

use App\Nova\Resource;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Repeater;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Mostafaznv\NovaCkEditor\CkEditor;

class SectionButton extends Resource {

    public static function label() {
        return 'Boutons de sections'; // Titre dans le menu
    }

    /*  ---------    Config   ----------------------------------------  */

    public static $model = \App\Models\SectionButton::class;

    public static $title = 'title';     // C'est le field qui sera utilisé pour "résumer" la ressource
    public static $search = ['title'];  // fields searchables


    // Menu
    public static $displayInNavigation = false;




    /*  ---------    Fields   ----------------------------------------  */

    public function fields(NovaRequest $request) {
        return [];
    }
}
