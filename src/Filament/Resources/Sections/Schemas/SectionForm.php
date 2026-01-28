<?php

namespace App\Filament\Resources\Sections\Schemas;

use App\Filament\Forms\Components\MyButtonsRepeater;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use JoliMardi\FilamentVideoField\VideoField;
use JoliMardi\MySections\Enums\SectionsMaxWidths;
use JoliMardi\MySections\Enums\SectionsTemplates;

class SectionForm {
	public static function configure(Schema $schema): Schema {
		return $schema
			->components([
				Section::make('Contenu')->schema([
					TextInput::make('title')->label('Titre'),
					TextInput::make('subheading')->label('Sous-titre')->columnStart(1),
					RichEditor::make('p')->label('Paragraphe')->columnSpanFull(),
				])->columns(2)->columnSpanFull(),


				Section::make('Medias')->schema([
					SpatieMediaLibraryFileUpload::make('image')->label('Image principale')->collection('image')->conversion('medium')
						->imageEditor()->imageEditorAspectRatioOptions([null, '16:9']),

					SpatieMediaLibraryFileUpload::make('photos')->collection('photos')->multiple()->reorderable()->conversion('medium')->panelLayout('grid')->itemPanelAspectRatio(1 / 1)->columnSpanFull()
						->imageEditor(),

					VideoField::make('video')->label('Vidéo'),

				])->columns(2)->columnSpanFull(),


				Section::make('Boutons')->schema([
					MyButtonsRepeater::make('buttons')->default([]),
				])->columns(2)->columnSpanFull(),

				Section::make('Options développeur')->schema([
					TextInput::make('key')->required()->placeholder('{page}.{section}')->helperText('Format: {page}.{section}'),
					Select::make('template_name')->label('Template')->options(SectionsTemplates::array())->nullable()->preload(),


					Select::make('max_width')->label('Max Width')->options(SectionsMaxWidths::array())->preload()->nullable(),
					Toggle::make('reverse')->label('Inverser la photo et le texte'),
					TextInput::make('classname')->label('Classe CSS')->helperText('Classes CSS personnalisées'),
					Toggle::make('alternative')->label('Version alternative'),
				])->columns(2)->columnSpanFull()->collapsed(fn(string $operation): bool => $operation === 'edit')

			]);
	}
}
