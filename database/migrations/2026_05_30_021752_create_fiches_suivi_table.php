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
             Schema::create('fiches_suivi', function (Blueprint $table) {

    $table->id();

    $table->foreignId('chien_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->decimal('poids',8,2)
          ->nullable();

    $table->decimal('temperature',5,2)
          ->nullable();

    $table->string('etat_general')
          ->nullable();

    $table->text('alimentation')
          ->nullable();

    $table->text('observation')
          ->nullable();

    $table->date('date_suivi');

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
        Schema::dropIfExists('fiches_suivi');
    }
};
