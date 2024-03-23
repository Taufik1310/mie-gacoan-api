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
        Schema::create('menus', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('name', 160);
            $table->text('description');
            $table->bigInteger('price');
            $table->text('picture')->default('/storage/images/default.png');
            $table->enum('status', [0, 1])->default(1); // 0: TIDAK TERSEDIA, 1: TERSEDIA
            $table->uuid('menuTypeId');
            $table->foreign('menuTypeId')->references('uuid')->on('menu_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
