<?php

namespace JoliMardi\MySections;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MySectionsServiceProvider extends ServiceProvider {
    public function boot() {

        $this->loadViewsFrom(__DIR__ . '/views', 'section');

        // Permet d'ajouter les fichiers que si on est en console (donc pas en prod)
        if ($this->app->runningInConsole()) {

            // Pour publish le css dans le dossier public, parfois ca peut-être mieux (Nova le fait )
            $this->publishes(
                [
                    __DIR__ . '/../dist' => public_path('vendor/mysections'),
                ],
                'assets'
            );

            // Nova + models
            $this->publishes([
                __DIR__ . '/Nova' => app_path('Nova'),
                __DIR__ . '/Models' => app_path('Models'),
            ], 'nova');

            // Migrations
            $this->publishes([
                __DIR__ . '/migrations' => database_path('migrations'),
            ], 'migrations');
        }

        Blade::directive('mySection', fn ($expression) => "<?php \JoliMardi\MySections\MySectionsServiceProvider::mySection($expression); ?>");

        /* Components */
        Blade::component('section', \JoliMardi\MySections\Components\Section::class);
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
            echo view('section::' . $section->template_name, ['section' => $section]);
        } else {
            echo '<!-- @mySection() : $section invalide, pas de template_name --!>';
        }
    }
}
