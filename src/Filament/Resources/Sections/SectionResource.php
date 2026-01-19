<?php

namespace App\Filament\Resources\Sections;

use App\Filament\Resources\Sections\Pages\CreateSection;
use App\Filament\Resources\Sections\Pages\EditSection;
use App\Filament\Resources\Sections\Pages\ListSections;
use App\Filament\Resources\Sections\Schemas\SectionForm;
use App\Filament\Resources\Sections\Tables\SectionsTable;
use App\Models\Section;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SectionResource extends Resource {
    protected static ?string $model = Section::class;

    // Config du menu et des noms
    protected static ?string $modelLabel = 'section';
    protected static ?string $pluralModelLabel = 'sections';
    protected static ?string $navigationLabel = 'Sections';
    protected static ?int $navigationSort = 100; // Place dans le menu
    protected static string|null|\UnitEnum $navigationGroup = 'Contenu'; // Groupe dans le menu
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCodeBracket; // Icone dans le menu

    // Attribut utilisé pour le titre d'un item
    protected static ?string $recordTitleAttribute = 'title';


    public static function form(Schema $schema): Schema {
        return SectionForm::configure($schema);
    }


    public static function table(Table $table): Table {
        return SectionsTable::configure($table);
    }


    public static function getRelations(): array {
        return [
            //
        ];
    }


    public static function getPages(): array {
        return [
            'index' => ListSections::route('/'),
            'create' => CreateSection::route('/create'),
            'edit' => EditSection::route('/{record}/edit'),
        ];
    }
}
