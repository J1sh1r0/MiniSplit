<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('invoice_rfc')->nullable();
            $table->string('invoice_name')->nullable();    // Razón Social / Nombre Receptor
            $table->string('invoice_regimen')->nullable(); // Régimen Fiscal
            $table->string('invoice_cfdi_use')->nullable(); // Uso de CFDI
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['invoice_rfc', 'invoice_name', 'invoice_regimen', 'invoice_cfdi_use']);
        });
    }
};
