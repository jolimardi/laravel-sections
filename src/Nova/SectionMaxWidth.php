<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SectionMaxWidth extends Resource {

    public static function label() {
        return 'Max-widths des Sections'; // Titre dans le menu
    }

    /*  ---------    Config   ----------------------------------------  */

    public static $model = \App\Models\SectionMaxWidth::class;

    public static $title = 'name';     // C'est le field qui sera utilisé pour "résumer" la ressource
    public static $search = ['name', 'class'];  // fields searchables

    // Menu
    public static $displayInNavigation = false;




    /*  ---------    Fields   ----------------------------------------  */


    public function fields(NovaRequest $request) {
        return [
            ID::make()->sortable()->hideFromIndex(),
            Text::make('Nom de la classe', 'name')->sortable(),
            Text::make('Classe', 'class')->sortable(),
        ];
    }
}
