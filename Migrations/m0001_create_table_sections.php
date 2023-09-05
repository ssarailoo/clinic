<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class m0001_create_table_sections
{
    public function up(): void
    {
        if (!Capsule::schema()->hasTable('sections')) {
            Capsule::schema()->create("sections", function (Blueprint $table) {
                $table->id();
                $table->string('name');

            });

        }
    }


    public function down(): void
    {
        if (Capsule::schema()->hasColumn('doctors', 'section_id')) {
            Capsule::schema()->table('doctors', function (Blueprint $table) {
                $table->dropConstrainedForeignId('section_id');
            });
        }
        Capsule::schema()->dropIfExists('sections');
    }
}