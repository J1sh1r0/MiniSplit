<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('colonia')->nullable();
            $table->string('number')->nullable();
            $table->string('no_interior')->nullable();
            $table->boolean('is_apartment')->default(false);
            $table->boolean('requires_invoice')->default(false);

            // Campos de facturación
            $table->string('invoice_rfc')->nullable();
            $table->string('invoice_name')->nullable();
            $table->string('invoice_regimen')->nullable();
            $table->string('invoice_cfdi_use')->nullable();
            $table->string('invoice_street')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('invoice_interior')->nullable();
            $table->string('invoice_colonia')->nullable();
            $table->string('invoice_city')->nullable();
            $table->string('invoice_state')->nullable();
            $table->string('invoice_zip')->nullable();
            $table->string('invoice_country')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
