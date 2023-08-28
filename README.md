# Jolimardi - laravel-sections

**Ce package fonctionne avec Laravel Nova, veillez donc à l'installer avant de poursuivre. Retrouver la documentation et les instructions d'installation de Laravel Nova sur leur [page officielle](https://nova.laravel.com/docs/4.0/installation.html)**

**Il est également préférable d'utiliser le css jolimardi pour assurer un bon fonctionnement. [jolimardi-css GitHub](https://github.com/jolimardi/jolimardi-css)**

## Installation 

1. Exécuter la commande suivante pour ajouter laravel-mysections au projet :

```bash
composer require jolimardi/laravel-sections
```

2. Publier les ressources du package en utilisant :

```bash
php artisan vendor:publish --provider="JoliMardi\MySections\MySectionsServiceProvider"
```

#### Tags

Il est également possible de *publish* le package en plusieurs fois en ajoutant différents tags, selon les besoins : 

- `php artisan vendor:publish --provider="JoliMardi\MySections\MySectionsServiceProvider" --tag="nova"` - *Publish aussi les models*
- `php artisan vendor:publish --provider="JoliMardi\MySections\MySectionsServiceProvider" --tag="migrations"`
- `php artisan vendor:publish --provider="JoliMardi\MySections\MySectionsServiceProvider" --tag="assets"`
- `php artisan vendor:publish --provider="JoliMardi\MySections\MySectionsServiceProvider" --tag="views"`

3. Lancez les migrations pour ajouter les tables nécessaires à la base de données :

```bash
php artisan migrate`
```

## Configuration

- Ajoutez `JoliMardi\MySections\MySectionsServiceProvider::class` à votre fichier `config/app.php`, seulement si cela s'avère nécessaire. Cette étape peut être requise si le package ne respecte pas la convention PSR-4 ou s'il est mal implémenté dans le `composer.json` autoload.

- Importez le fichier CSS du package dans `app.css` en ajoutant la ligne suivante *(Recommandé avec Vite.js)*:

```css
@import "../../public/vendor/mysections/sections.css";
```

> En développement, on préferera utiliser `@import "../../vendor/jolimardi/laravel-mysections/dist/sections.css";` pour ne pas avoir à publish les assets à chaque sauvegarde.

## Utilisation

Utilisez la fonction `mySection($data, $key)` dans une views pour insérer une section. Pour passer des données spécifiques à la section ainsi que sa clé correspondante.

## Composants

Il est possible d'utiliser le composant `<x-section>` dans une views afin de définir des règles CSS pré-établies pour les sections. Voici un exemple :

```html
<x-layout>
    @mySection($sections, 'home.about')

    <x-section maxWidth="large" bg="gray">
        <x-list-icon />
    </x-section>
</x-layout>
```

## Customisé les sections

Après avoir éxécuter la commande : 
```bash
php artisan vendor:publish --provider="JoliMardi\MySections\MySectionsServiceProvider" --tag="views"
```

Retrouver dans `resources/views/vendor/laravel-sections` les vues des différentes sections qui sont utiliser pour render respectivement chaque section par défaut. 

## Création d'une nouvelle section

Voici les étapes à suivre pour créer une nouvelle section :

1. Ouvrez Nova et rendez-vous sur le tableau de bord. 
2. Dans le menu, cliquez sur "Sections" pour ouvrir la liste des sections.
3. Cliquez sur "Ajouter une nouvelle section".
> Si vous avez ajouter une nouvelle section au packages, pensez à vous rentre sur "Sections templates" en amont pour lui donner un nom afin de pouvoir l'utiliser lors de la sélection du template
4. Sélectionnez les paramètres de la section. Trois sections sont pré-définies, mais il est possible d'en ajouter d'autres.
5. Pour ajouter une nouvelle section, allez dans "Section templates" sur Nova.
6. Donnez un nom à votre section et sélectionnez une vue.

_Remarque :_ Ces instructions supposent que vous êtes déjà familiarisé avec l'utilisation de Nova et de Laravel. Si ce n'est pas le cas, je vous recommande de consulter la documentation officielle pour plus d'informations.


# Changer le contenu du package 

Il est possible d'update le package à sa guise. 

1. Installer les dépendances 

```bash
composer install
npm install
```

2. Modifier un fichier css à chaque sauvegarde `dist/sections.css`

```bash
npx mix watch
```

Ou mettre à jour une fois en utilisant :

```bash
npx mix
```

> Remarque : Si vous modifier le contenu de `/dist` et que vous avez publish les assets. Il faut supprimer le fichier `section.css` dans `public/vendor/mysections` et relancer la commande pour publish le nouveaux fichier. (Voir Installation -> Tags)

## Ajouter une nouvelle section au package

1. **Ajouter une nouvelle vue :** Créez et ajoutez une nouvelle vue dans le dossier `src/views`.

2. **Ajouter un fichier CSS :** Créez et ajoutez un fichier CSS correspondant dans le dossier `src/css`.

3. **Mettre à jour le fichier `webpack.mix.js` :** Ajoutez le fichier CSS à la configuration du `webpack.mix.js`.

4. **Compilation des assets :** Exécutez la commande npx mix pour recompiler les assets et actualiser le dossier `dist`.

5. **Mise à jour du submodule :** Si vous utilisez ce package en tant que submodule dans un autre projet, assurez-vous de mettre à jour le submodule.

6. **Référence :** Ensuite, reportez-vous à la section 'Création d'une nouvelle section' pour plus de détails sur la création d'une nouvelle section.

**Note :** Si on ajoute un fichier css, il faut l'ajouter au `webpack.mix.js` et relancé la commande `npx mix watch`.

Puis mettre à jour le dépôt et de mettre à jour votre projet avec les nouvelles modifications.

#### @TODO

- Ajouter les variables css type max-width pour pouvoir utiliser le component `<x-section><x-section />` sans avoir besoin de jolimardi-css
- Build le webpack.mix.js pour automatiquement récuperer tout les fichiers css du dossier relatif.  J'ai essayer de glob les fichiers mais j'ai toujours un comportement qui ne convient pas. 