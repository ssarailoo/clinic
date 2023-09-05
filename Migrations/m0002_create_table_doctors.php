<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class m0002_create_table_doctors
{
    public function up(): void
    {
        if (!Capsule::schema()->hasTable('doctors')) {
            Capsule::schema()->create("doctors", function (Blueprint $table) {
                $table->id();
                $table->string('firstname', '255');
                $table->string('lastname', '255');
                $table->string('email', '255');
                $table->string('education', '255');
                $table->string('password');
                $table->unsignedBigInteger('section_id')->nullable()->default(null);
                $table->integer('medical_code');
                $table->boolean('is_active')->default(false);
                $table->boolean('is_completed')->default(false);
                $table->foreign('section_id')->references("id")->on('sections')->onDelete('cascade');

            });

        }

    }

    public function down(): void
    {

        Capsule::schema()->dropIfExists('doctors');
    }

}