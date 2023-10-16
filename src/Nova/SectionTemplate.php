<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SectionTemplate extends Resource {
    
    public static function label() {
        return 'Templates des Sections'; // Titre dans le menu
    }

    /*  ---------    Config   ----------------------------------------  */

    public static $model = \App\Models\SectionTemplate::class;

    public static $title = 'name';     // C'est le field qui sera utilisé pour "résumer" la ressource
    public static $search = ['name', 'description'];  // fields searchables

    // Menu
    public static $displayInNavigation = false;




    /*  ---------    Fields   ----------------------------------------  */
    
    public function fields(NovaRequest $request) {
        return [
            ID::make()->sortable()->hideFromIndex(),
            Text::make('Slug', 'name')->sortable(),
            Text::make('Description', 'description')->nullable(),
        ];
    }
}
