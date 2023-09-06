<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class m0004_create_table_patients
{
    public function up(): void
    {
        if (!Capsule::schema()->hasTable('patients')) {
            Capsule::schema()->create("patients", function (Blueprint $table) {
                $table->id();
                $table->string('firstname', '255');
                $table->string('lastname', '255');
                $table->string('email', '255');
                $table->string('password');
                $table->tinyInteger('code_role')->default(0);

            });
        }
    }

    public function down(): void
    {
        Capsule::schema()->dropIfExists('patients');
    }
}