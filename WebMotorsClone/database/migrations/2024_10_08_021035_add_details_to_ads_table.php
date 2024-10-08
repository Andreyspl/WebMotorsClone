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
        Schema::table('ads', function (Blueprint $table) {
            $table->integer('mileage')->nullable();
            $table->year('year')->nullable();
            $table->string('license_plate_start', 3)->nullable();
            $table->enum('transmission', ['Automático', 'Manual'])->default('Manual');
            $table->boolean('single_owner')->default(false);
            $table->string('color')->nullable();
            $table->json('photos')->nullable(); // Para armazenar as URLs das fotos
        });
    }

    public function down()
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn(['mileage', 'year', 'license_plate_start', 'transmission', 'single_owner', 'color', 'photos']);
        });
    }

};
