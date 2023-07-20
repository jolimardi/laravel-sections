<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\TextArea;
use Laravel\Nova\Fields\BelongsTo;

use Mostafaznv\NovaCkEditor\CkEditor;
use Laravel\Nova\Http\Requests\NovaRequest;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use MAKO\YoutubeField\YoutubeField;

class Section extends Resource {
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Section>
     */
    public static $model = \App\Models\Section::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'key';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'key', 'title'
    ];

    public static $group = 'Contenu';

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request) {
        return [
            ID::make()->sortable()->hideFromIndex(),

            Text::make('Key')->sortable()->copyable()->placeholder('{page}.{section}'),
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

            YoutubeField::make('Vidéo url', 'video_url')->hideFromIndex(),

            Images::make('Cover de la vidéo', 'video_thumbnail')
                ->conversionOnIndexView('thumb')
                ->withResponsiveImages()
                ->hideFromIndex(),


        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request) {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request) {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request) {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request) {
        return [];
    }
}
