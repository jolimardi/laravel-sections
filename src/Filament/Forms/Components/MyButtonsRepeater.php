<?php

namespace App\Filament\Forms\Components;

use App\Filament\Forms\Components\RouteSelector;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Components\Utilities\Get;
use JoliMardi\MySections\Enums\SectionsButtonIcons;
use JoliMardi\MySections\Enums\SectionsButtonTypes;

class MyButtonsRepeater extends Repeater {

	protected function setUp(): void {
		parent::setUp();

		$this->label('Boutons')->schema([

			TextInput::make('title')->label('Label du bouton')->required()->columnSpanFull(),

			Select::make('type')->label('Couleur')->options(SectionsButtonTypes::array())->default('btn-primary')->required(),

			Select::make('icon')->label('Icône')->options(SectionsButtonIcons::array())->default('')->nullable()->placeholder('Aucune icone'),

			ToggleButtons::make('link_type')->label('Type de lien')
				->options([
					'route' => 'Route interne (recommandé)',
					'href' => 'Lien complet https://...',
				])->default('route')->inline()->grouped()->live()->columnSpanFull(),

			RouteSelector::make('routename')
				->label('Nom interne de la route')
				->visible(fn(Get $get): bool => $get('link_type') === 'route')
				->columnSpanFull(),

			TextInput::make('href')->label('Lien href')->visible(fn(Get $get): bool => $get('link_type') === 'href')->columnSpanFull()->helperText('/contact pour une page interne du site, ou https://site-externe.com/...'),

			Toggle::make('target_blank')->label('Nouvel onglet ? (pas recommandé)')->default(false)->columnSpanFull(),
		])
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
			->itemLabel(fn(array $state): ?string => (($state['title'] ?? 'Vide') . ' -> ' . ($state['routename'] ?? $state['href'] ?? 'Aucun lien')))
			->reorderable()
			->cloneable()
			->collapsed()
			->addActionLabel('Ajouter un bouton')
			->hiddenLabel()
			->live()
			->columnSpanFull()
			->nullable()->compact();

	}
}
