<?php

namespace App\Nova\Repeater;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Repeater\Repeatable;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Mostafaznv\NovaCkEditor\CkEditor;

class SectionButton extends Repeatable {

    public static function label() {
        return 'Bouton'; // Titre dans le menu
    }


    /**
     * Get the fields displayed by the repeatable.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request) {
        return [

            Text::make('Label du bouton', 'title'),
            Text::make('Routename', 'routename'),
            Text::make('Lien href (si pas de routename)', 'href'),


            Select::make('Icone', 'icon')->options([
                '' => 'Aucune',
                'coolicon-chevron-right-md' => 'Chevron droite',
                'coolicon-arrow-right-md' => 'Flèche droite',
            ])->default('')->displayUsingLabels(),

            Select::make('Type', 'type')->options([
                'primary' => 'Primary',
                'secondary' => 'Secondary',
            ])->default('primary')->displayUsingLabels(),

            Boolean::make('Nouvel onglet ? (pas recommandé)', 'target_blank')->default(false),


        ];
    }
    public static $model = \App\Models\SectionButton::class;
}
