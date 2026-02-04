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
			$this->publishes([
				__DIR__ . '/../dist' => public_path('vendor/mysections'),
			], 'assets');

			// Models
			$this->publishes([
				__DIR__ . '/Models' => app_path('Models'),
			], 'models');

			// Filament
			$this->publishes([
				__DIR__ . '/Filament' => app_path('Filament'),
			], 'filament');

			// Migrations
			$this->publishes([
				__DIR__ . '/migrations' => database_path('migrations'),
			], 'migrations');

			// Vue
			$this->publishes([
				__DIR__ . '/views' => resource_path('views/vendor/laravel-sections'),
			], 'views');

			// Enums (stubs avec namespace App\Enums)
			$this->publishes([
				__DIR__ . '/Enums' => app_path('Enums'),
			], 'enums');

			// Icône play vidéo (sert pour le component video-popup)
			$this->publishes([
				__DIR__ . '/icons' => resource_path('icons'),
			], 'icons');
		}

		Blade::directive('mySection', fn($expression) => "<?php \JoliMardi\MySections\MySectionsServiceProvider::mySection($expression); ?>");

		/* Components */
		Blade::component('section', \JoliMardi\MySections\Components\Section::class);
		Blade::component('section-button', \JoliMardi\MySections\Components\SectionButton::class);
		Blade::component('video-inline', \JoliMardi\MySections\Components\VideoInline::class);
		Blade::component('video-popup', \JoliMardi\MySections\Components\VideoPopup::class);
	}


	public function register() {
		$this->registerEnumAliases();
	}


	/**
	 * Enregistre les aliases pour les enums.
	 * Si App\Enums\X existe, on l'utilise, sinon on utilise la version par défaut du package.
	 */
	protected function registerEnumAliases(): void {
		$enums = [
			'SectionsButtonIcons',
			'SectionsButtonTypes',
			'SectionsMaxWidths',
			'SectionsTemplates',
		];

		foreach ($enums as $enum) {
			$appClass = "App\\Enums\\{$enum}";
			$packageAlias = "JoliMardi\\MySections\\Enums\\{$enum}";

			// Si la classe App existe, on l'aliase vers le namespace du package
			// Ajouter un check sur class_alias s'il existe déjà :
			$aliasExists = class_exists($packageAlias);

			// Si l'alias n'existe pas et que la classe App existe, on l'aliase vers le namespace du package
			if (! $aliasExists && class_exists($appClass)) {
				class_alias($appClass, $packageAlias);
			}
		}
	}


	public static function mySection($data, $key = false) {

		if ($key) {
			$sections = $data;

			if ( ! isset($sections[$key])) {
				echo '<!-- $sections["' . $key . '"] introuvable depuis @mySection() --!>';
				return;
			} else {
				$section = $sections[$key];
			}
		} else {
			$section = $data;
		}
		if (isset($section->template_name)) {
			if (view()->exists('vendor.laravel-sections.' . $section->template_name)) {
				echo view('vendor.laravel-sections.' . $section->template_name, ['section' => $section]);
			} else {
				echo view('section::' . $section->template_name, ['section' => $section]);
			}
		} else {
			echo '<!-- @mySection() : $section invalide, pas de template_name --!>';
		}
	}
}
