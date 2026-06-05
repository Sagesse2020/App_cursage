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
               Schema::create('traitements', function (Blueprint $table) {

    $table->id();

    $table->foreignId('chien_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->string('nom_traitement');

    $table->date('date_debut');

    $table->date('date_fin')
          ->nullable();

    $table->decimal('cout',12,2)
          ->default(0);

    $table->text('description')
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
        Schema::dropIfExists('traitements');
    }
};
