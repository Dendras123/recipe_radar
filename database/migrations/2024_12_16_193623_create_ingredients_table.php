<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();

            $table->string('name')->nullable();
            // amount
            $table->integer('quantity')->nullable();
            $table->float('weight')->nullable();
            // calories and macros
            $table->float('calories')->nullable();
            $table->float('protein')->nullable();
            $table->float('carbs')->nullable();
            $table->float('sugar')->nullable();
            $table->float('fiber')->nullable();
            $table->float('fat')->nullable();
            // expiration date
            $table->dateTime('expires_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
