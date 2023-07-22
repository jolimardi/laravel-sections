# Jolimardi - laravel-mysections

**Ce package fonctionne avec Laravel Nova, veillez donc à l'avoir installé avant de poursuivre. Vous pouvez trouver la documentation et les instructions d'installation de Laravel Nova sur leur [page officielle](https://nova.laravel.com/docs/4.0/installation.html)**

## Installation 

1. Exécutez la commande suivante pour ajouter laravel-mysections au projet :

```bash
composer require jolimardi/laravel-sections
```

2. Publiez les ressources du package en utilisant :

```bash
php artisan vendor:publish --provider="JoliMardi\MySections\MySectionsServiceProvider"
```

3. Lancez les migrations pour ajouter les tables nécessaires à la base de données :

```bash
php artisan migrate`
```

## Configuration

- Ajoutez `JoliMardi\MySections\MySectionsServiceProvider::class` à votre fichier `config/app.php`, seulement si cela s'avère nécessaire. Cette étape peut être requise si le package ne respecte pas la convention PSR-4 ou s'il est mal implémenté dans le `composer.json` autoload.

- Importez le fichier CSS du package dans votre fichier app.css en ajoutant la ligne suivante :

```css
@import "../../vendor/jolimardi/laravel-mysections/dist/sections.css";
```

## Configuration

Utilisez la fonction `mySection($data, $key)` dans vos views pour insérer une section. Vous pouvez passer des données spécifiques à la section ainsi que sa clé correspondante.

N'hésitez pas à contacter le support si vous rencontrez des problèmes lors de l'installation ou de l'utilisation de ce package.

## TODO 

- Ajouter process de création de section ?
