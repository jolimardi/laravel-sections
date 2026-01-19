<?php

namespace App\Filament\Resources\Sections\Tables;

use App\Models\Section;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SectionsTable {
    public static function configure(Table $table): Table {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable()->weight(FontWeight::Medium)->description(fn(Section $section): string => $section->subheading ?? '', 'above'),
                //TextColumn::make('subheading')->searchable()->sortable()->weight(FontWeight::Light),
                TextColumn::make('key')->searchable()->sortable()->size(TextSize::ExtraSmall),
//                TextColumn::make('template_name')->searchable(),
//                IconColumn::make('reverse')->boolean(),
//                IconColumn::make('alternative')->boolean(),
                TextColumn::make('classname')->searchable(),
//                TextColumn::make('max_width')->searchable(),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('key', 'asc')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
