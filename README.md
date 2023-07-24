# Jolimardi - laravel-mysections

**Ce package fonctionne avec Laravel Nova, veillez donc à l'avoir installé avant de poursuivre. Vous pouvez trouver la documentation et les instructions d'installation de Laravel Nova sur leur [page officielle](https://nova.laravel.com/docs/4.0/installation.html)**

**Il est également préférable d'utiliser le css jolimardi pour assurer un bon fonctionnement. [jolimardi-css GitHub](https://github.com/jolimardi/jolimardi-css)**

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

## Utilisation

Utilisez la fonction `mySection($data, $key)` dans vos views pour insérer une section. Vous pouvez passer des données spécifiques à la section ainsi que sa clé correspondante.

N'hésitez pas à contacter le support si vous rencontrez des problèmes lors de l'installation ou de l'utilisation de ce package.

## Composants

Il est possible d'utiliser le composant `<x-section>` dans vos vues afin de définir des règles CSS pré-établies pour les sections. Voici un exemple :

```html
<x-layout>
    @mySection($sections, 'home.about')

    <x-section maxWidth="large" bg="gray">
        <x-list-icon />
    </x-section>
</x-layout>
```

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