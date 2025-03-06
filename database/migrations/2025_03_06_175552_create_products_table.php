<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->integer('tonnage'); // 1 o 2 toneladas
            $table->string('features'); // Frío/Calor, Inverter, etc.
            $table->decimal('price', 10, 2);
            $table->decimal('offer_price', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('products');
    }
};
