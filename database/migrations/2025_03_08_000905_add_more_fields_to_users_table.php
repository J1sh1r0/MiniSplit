<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Volver "nullable" o con default la columna last_name
            // para evitar el error "doesn't have a default value"
            $table->string('last_name', 255)->nullable()->change();

            // Campos nuevos
            $table->string('colonia')->nullable();
            $table->string('number')->nullable(); // número de la calle
            $table->string('no_exterior')->nullable();
            $table->string('no_interior')->nullable();
            $table->boolean('is_apartment')->default(false);
            $table->boolean('requires_invoice')->default(false);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Revertir cambios si fuera necesario
            $table->string('last_name', 255)->change();
            $table->dropColumn([
                'colonia',
                'number',
                'no_exterior',
                'no_interior',
                'is_apartment',
                'requires_invoice',
            ]);
        });
    }
};

