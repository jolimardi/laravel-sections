<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Text;

class MyButtonsRepeater extends Repeater {

    protected function setUp(): void {
        parent::setUp();

        $this->label('Boutons')->schema([

            Fieldset::make('Texte et apparence')->schema([
                TextInput::make('title')->label('Label du bouton')->required(),
                Select::make('type')->label('Couleur')->options([
                    'btn-primary' => 'Primary',
                    'btn-secondary' => 'Secondary',
                ])->default('btn-primary')->required(),
                Select::make('icon')->label('Icône')->options([
                    '' => 'Aucune',
                    'coolicon-chevron-right-md' => 'Chevron droite',
                    'coolicon-arrow-right-md' => 'Flèche droite',
                ])->default(''),

            ])->columns(1),
            Fieldset::make('Lien')->schema([
                Text::make('buttonHelpText')->content('Soit un nom de route interne (recommandé), soit un lien href complet (https://...)')->columnSpanFull(),
                TextInput::make('routename')->label('Nom interne de la route'),
                TextInput::make('href')->label('Lien href'),
                Toggle::make('target_blank')->label('Nouvel onglet ? (pas recommandé)')->default(false),
            ])->columns(1),
        ])->columns(2)
            ->mutateDehydratedStateUsing(function ($state) {
                if (is_array($state)) {
                    return array_map(function ($item) {
                        return [
                            'type' => 'section-button',
                            'fields' => $item,
                        ];
                    }, $state);
                }
                return $state;
            })
            ->afterStateHydrated(function ($component, $state) {
                if (is_array($state)) {
                    $flattenedState = array_map(function ($item) {
                        return $item['fields'] ?? $item;
                    }, $state);
                    $component->state($flattenedState);
                }
            })
            ->itemLabel(fn(array $state): ?string => (($state['title'] ?? '(Pas de label)') . ' [->' . ($state['routename'] ?? $state['href'] ?? 'Aucun lien') . ']'))
            ->reorderable()
            ->cloneable()
            ->collapsed()
            ->addActionLabel('Ajouter un bouton')
            ->hiddenLabel()
            ->live()
            ->columnSpanFull()
            ->nullable();

    }


}
