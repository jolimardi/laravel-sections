<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {

        /* ----------   Update de l'ancienne table  ----------- */
        Schema::table('sections_content', function (Blueprint $table) {
            // Ajout de la nouvelle ligne
            $table->json('buttons')->nullable()->default(null)->after('p');
        });


        /* --------- Import des anciens boutons vers le nouveau format  ----------- */
        // Get records from old column.
        $buttons = DB::table('sections_buttons')->select('*')->get();

        // Group by section_id
        $buttons = $buttons->groupBy('section_id');

        // Loop through the results of the old column, and insert json into the new column.
        foreach ($buttons as $section_id => $section_buttons) {
            $buttons_array = [];
            foreach ($section_buttons as $button) {
                $buttons_array[] = [
                    'type' => 'section-button',
                    'fields' => [
                        'title' => $button->title,
                        'routename' => $button->routename,
                        'href' => $button->href,
                        'icon' => $button->icon,
                        'type' => $button->type,
                        'target_blank' => $button->target_blank,
                    ]
                ];
            }
            // get section and insert $section->buttons = $buttons_array
            DB::table('sections_content')->where('id', $section_id)->update(['buttons' => json_encode($buttons_array)]);
        }


        /* ----------   Update de l'ancienne table  ----------- */
        Schema::rename('sections_buttons', 'sections_buttons_unused');
    }


    public function down() {
        Schema::dropIfExists('sections_buttons');

        // On remet les champs qu'on a supprimés/renommés
        Schema::table('sections_content', function (Blueprint $table) {
            // Pour renommer après renommage
            $table->dropColumn('buttons');
        });

        /* ----------   Update de l'ancienne table  ----------- */
        Schema::rename('sections_buttons_unused', 'sections_buttons');
    }
};
