<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsTo;

use Mostafaznv\NovaCkEditor\CkEditor;
use Laravel\Nova\Http\Requests\NovaRequest;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use JoliMardi\NovaVideoField\NovaVideoField;

class Section extends Resource {


    public static function label() {
        return 'Sections'; // Titre dans le menu
    }

    /*  ---------    Config   ----------------------------------------  */

    public static $model = \App\Models\Section::class;

    public static $title = 'key';     // C'est le field qui sera utilisé pour "résumer" la ressource
    public static $search = ['key', 'title'];  // fields searchables

    // Menu
    public static $group = 'Contenu';  // Groupe dans le menu




    /*  ---------    Fields   ----------------------------------------  */

    public function fields(NovaRequest $request) {
        return [
            ID::make()->sortable()->hideFromIndex(),

            Text::make('Key')->sortable()->placeholder('{page}.{section}'),
            BelongsTo::make('Template', 'template', 'App\Nova\SectionTemplate')->nullable(),

            Text::make('Titre', 'title')->sortable(),
            Text::make('Subheading'),
            CkEditor::make('Paragraphe', 'p')->stacked()->fullwidth()->hideFromIndex(),

            Text::make('CTA Title', 'cta_title')->hideFromIndex(),
            Text::make('CTA Routename', 'cta_routename')->hideFromIndex(),
            Text::make('CTA Href', 'cta_href')->hideFromIndex(),
            Text::make('CTA Secondary Title', 'cta_secondary_title')->hideFromIndex(),
            Text::make('CTA Secondary Routename', 'cta_secondary_routename')->hideFromIndex(),
            Text::make('CTA Secondary Href', 'cta_secondary_href')->hideFromIndex(),

            Boolean::make('Reverse', 'reverse')->hideFromIndex(),
            Boolean::make('Alternative', 'alternative')->hideFromIndex(),
            BelongsTo::make('Max width', 'max_width_relationship', 'App\Nova\SectionMaxWidth')->nullable()->hideFromIndex(),
            Text::make('Classname', 'classname'),

            // Media Library
            Images::make('Image principale', 'image')
                ->conversionOnIndexView('thumb')
                ->withResponsiveImages()
                ->hideFromIndex(),

            Images::make('Photos', 'photos')
                ->fullSize()
                ->withResponsiveImages()
                ->hideFromIndex(),

            NovaVideoField::make('Vidéo', 'video')->nullable()->hideFromIndex(),


        ];
    }
}
