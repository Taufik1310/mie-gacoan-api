<?php

use App\Models\MenuType;
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
        Schema::create('menu_types', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('name', 100);
            $table->timestamps();
        });

        $data =  array(
            [
                'name' => 'Mie',
            ],
            [
                'name' => 'Dimsum',
            ],
            [
                'name' => 'Minuman',
            ],
        );
        foreach ($data as $datum){
            $category = new MenuType();
            $category->name =$datum['name'];
            $category->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_types');
    }
};
