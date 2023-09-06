<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
class m0003_create_table_managers
{
    public function up(): void
    { if (!Capsule::schema()->hasTable('managers')) {
        Capsule::schema()->create("managers", function (Blueprint $table) {
            $table->id();
            $table->string('firstname', '255');
            $table->string('lastname', '255');
            $table->string('email', '255');
            $table->string('password');
            $table->tinyInteger('code_role')->default(2);
            $table->boolean('is_active')->default(false);
        });
    }
    }

    public function down(): void
    {
        Capsule::schema()->dropIfExists('managers');
    }

}