<?php

use App\Models\IngredientType;
use App\Models\Recepie;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recepies_ingredient_types', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(IngredientType::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Recepie::class)->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recepies_ingredient_types');
    }
};
