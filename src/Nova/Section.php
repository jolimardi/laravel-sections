<?php

namespace App\Nova;

use App\Nova\Repeater\SectionButton;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Repeater;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsTo;

use Laravel\Nova\Panel;
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

            new Panel('Contenu', [
                Text::make('Titre', 'title')->sortable(),
                Text::make('Subheading'),

                // Media Library
                Images::make('Image principale', 'image')
                    ->conversionOnIndexView('thumb')
                    ->withResponsiveImages()
                    ->hideFromIndex(),

                CkEditor::make('Paragraphe', 'p')->stacked()->fullwidth()->hideFromIndex(),

                Images::make('Photos', 'photos')
                    ->fullSize()
                    ->withResponsiveImages()
                    ->hideFromIndex(),

                NovaVideoField::make('Vidéo', 'video')->nullable()->hideFromIndex(),
            ]),


            new Panel('Boutons', [
                Repeater::make('SectionButton', 'buttons')
                    ->asHasMany()
                    ->fullWidth()
                    ->stacked()
                    ->repeatables([
                        SectionButton::make(),
                    ]),
            ]),


            new Panel('Clé unique (ne pas modifier)', [
                ID::make()->sortable()->hideFromIndex(),
                Text::make('Key')
                    ->sortable()
                    ->placeholder('{page}.{section}')
                    ->updateRules('unique:sections_content,key,{{resourceId}}'),
            ]),


            new Panel('Configuration', [
                BelongsTo::make('Template', 'template', 'App\Nova\SectionTemplate')->nullable(),
                Boolean::make('Reverse', 'reverse')->hideFromIndex(),
                Boolean::make('Alternative', 'alternative')->hideFromIndex(),
                BelongsTo::make('Max width', 'max_width_relationship', 'App\Nova\SectionMaxWidth')->nullable()->hideFromIndex(),
                Text::make('Classname', 'classname'),
            ]),

        ];
    }
}
