<?php

namespace JoliMardi\MySections;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MySectionsServiceProvider extends ServiceProvider {
    public function boot() {

        $this->loadViewsFrom(__DIR__ . '/views', 'mysections');

        // Nova + models
        $this->publishes([
            __DIR__ . '/Nova' => app_path('Nova'),
            __DIR__ . '/Models' => app_path('Models'),
        ], 'nova');

        // Publish views + css
        $this->publishes([
            __DIR__ . '/views' => resource_path('views/sections'),
            __DIR__ . '/css' => resource_path('css/custom'),
        ], 'views');

        // Publish migrations
        $this->publishes([
            __DIR__ . '/migrations' => database_path('migrations'),
        ], 'migrations');

        Blade::directive('mySection', fn ($expression) => "<?php \JoliMardi\MySections\MySectionsServiceProvider::mySection($expression); ?>");
    }

    public function register() {
    }

    public static function mySection($data, $key = false) {

        if ($key) {
            $sections = $data;

            if (!isset($sections[$key])) {
                echo '<!-- $sections["' . $key . '"] introuvable depuis @mySection() --!>';
                return;
            } else {
                $section = $sections[$key];
            }
        } else {
            $section = $data;
        }
        if (isset($section->template_name)) {
            echo view('sections.' . $section->template_name, ['section' => $section]);
        } else {
            echo '<!-- @mySection() : $section invalide, pas de template_name --!>';
        }
    }
}
