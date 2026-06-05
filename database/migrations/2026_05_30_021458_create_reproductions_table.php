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
            Schema::create('reproductions', function (Blueprint $table) {

    $table->id();

    $table->foreignId('male_id')
          ->constrained('chiens')
          ->cascadeOnDelete();

    $table->foreignId('femelle_id')
          ->constrained('chiens')
          ->cascadeOnDelete();

    $table->date('date_reproduction');

    $table->string('resultat')
          ->nullable();

    $table->text('observations')
          ->nullable();

    $table->foreignId('user_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reproductions');
    }
};
