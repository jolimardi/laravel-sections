<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {

        /* --------   Création de la DB pour les nouveaux boutons  --------------- */
        Schema::create('sections_buttons', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id');
            $table->string('title', 127)->nullable()->default(null);
            $table->string('routename', 127)->nullable()->default(null);
            $table->string('href')->nullable()->default(null);
            $table->string('icon', 128)->nullable()->default(null);
            $table->string('type', 128)->nullable()->default(null);
            $table->boolean('target_blank')->default(false);
        });

        /* --------- Import des anciens boutons vers le nouveau format  ----------- */
        // Get records from old column.
        $sections = DB::table('sections_content')->select('*')->get();

        // Loop through the results of the old column, split the values.
        // For example, let's say you have to explode a |.
        foreach ($sections as $section) {
            if (!empty($section->cta_title)) {
                DB::table('sections_buttons')->insert([
                    "section_id" => $section->id,
                    "title" => $section->cta_title,
                    "routename" => $section->cta_routename,
                    "href" => $section->cta_href,
                    'type' => 'primary',
                    'target_blank' => 0,
                ]);
            }
            if (!empty($section->cta_secondary_title)) {
                DB::table('sections_buttons')->insert([
                    "section_id" => $section->id,
                    "title" => $section->cta_secondary_title,
                    "routename" => $section->cta_secondary_routename,
                    "href" => $section->cta_secondary_href,
                    'type' => 'secondary',
                    'target_blank' => 0,
                ]);
            }
        }


        /* ----------   Update de l'ancienne table  ----------- */
        Schema::table('sections_content', function (Blueprint $table) {

            // Méthode avec suppression
            /*$table->dropColumn(['cta_title', 'cta_routename', 'cta_href', 'cta_secondary_title', 'cta_secondary_routename', 'cta_secondary_href']);*/

            // Méthode avec renommage de champs, plus douce
            $table->renameColumn('cta_title', 'cta_title_unused');
            $table->renameColumn('cta_routename', 'cta_routename_unused');
            $table->renameColumn('cta_href', 'cta_href_unused');
            $table->renameColumn('cta_secondary_title', 'cta_secondary_title_unused');
            $table->renameColumn('cta_secondary_routename', 'cta_secondary_routename_unused');
            $table->renameColumn('cta_secondary_href', 'cta_secondary_href_unused');


        });
    }


    public function down() {
        Schema::dropIfExists('sections_buttons');

        // On remet les champs qu'on a supprimés/renommés
        Schema::table('sections_content', function (Blueprint $table) {

            // Pour renommer après renommage
            $table->renameColumn('cta_title_unused', 'cta_title');
            $table->renameColumn('cta_routename_unused', 'cta_routename');
            $table->renameColumn('cta_href_unused', 'cta_href');
            $table->renameColumn('cta_secondary_title_unused', 'cta_secondary_title');
            $table->renameColumn('cta_secondary_routename_unused', 'cta_secondary_routename');
            $table->renameColumn('cta_secondary_href_unused', 'cta_secondary_href');


            // Pour remettre après suppression
            /*$table->string('cta_title')->nullable()->default('NULL');
            $table->string('cta_routename')->nullable()->default('NULL');
            $table->string('cta_href')->nullable()->default('NULL');
            $table->string('cta_secondary_title')->nullable()->default('NULL');
            $table->string('cta_secondary_routename')->nullable()->default('NULL');
            $table->string('cta_secondary_href')->nullable()->default('NULL');*/
        });

    }
};
