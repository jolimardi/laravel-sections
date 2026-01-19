<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Route;

class RouteSelector extends Select {
    protected function setUp(): void {
        parent::setUp();

        $this->searchable();

        $this->loadStateFromRelationshipsUsing(function (Select $component, $state) {
            $component->state($state);
        });

        $this->getOptionLabelUsing(function ($value): string {
            $route = Route::getRoutes()->getByName($value);
            return $route ? $value . ' (' . $route->uri() . ')' : $value;
        });
    }

    public function getOptions(): array {
        return collect(Route::getRoutes())
            ->filter(fn($route) => $route->getName())
            ->mapWithKeys(fn($route) => [
                $route->getName() => $route->getName() . ' (' . $route->uri() . ')'
            ])
            ->sort()
            ->toArray();
    }
}
