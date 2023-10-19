<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {

        Schema::create('sections_max_widths', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('class')->nullable();
            $table->timestamps();
        });

        Schema::create('sections_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });


        Schema::create('sections_content', function (Blueprint $table) {
            $table->id();
            $table->string('key', 100);
            $table->string('template_name', 100)->nullable();

            $table->text('title')->nullable();
            $table->text('subheading')->nullable();
            $table->mediumText('p')->nullable();

            $table->string('cta_title')->nullable();
            $table->string('cta_routename')->nullable();
            $table->string('cta_href')->nullable();

            $table->string('cta_secondary_title')->nullable();
            $table->string('cta_secondary_routename')->nullable();
            $table->string('cta_secondary_href')->nullable();

            $table->boolean('reverse')->nullable();
            $table->boolean('alternative')->nullable()->default(false);
            $table->string('classname')->nullable();
            $table->string('max_width')->nullable();

            $table->json('video')->nullable();

            $table->timestamps();
        });


        // Quelques valeurs pré-remplies
        DB::table('sections_max_widths')->insert([
            'name' => 'max-width',
            'class' => 'max-width'
        ]);
        DB::table('sections_max_widths')->insert([
            'name' => 'max-width-small',
            'class' => 'max-width-small'
        ]);
        DB::table('sections_max_widths')->insert([
            'name' => 'max-width-large',
            'class' => 'max-width-large'
        ]);

        DB::table('sections_templates')->insert([
            'name' => 'text-with-image',
            'description' => 'Text with Image'
        ]);
        DB::table('sections_templates')->insert([
            'name' => 'text',
            'description' => 'Texte'
        ]);
        DB::table('sections_templates')->insert([
            'name' => 'text-with-video',
            'description' => 'Text with Video'
        ]);
        DB::table('sections_templates')->insert([
            'name' => 'horizontal-card',
            'description' => 'Horizontal Card'
        ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('sections_max_widths');
        Schema::dropIfExists('sections_content');
        Schema::dropIfExists('sections_templates');
    }
};
