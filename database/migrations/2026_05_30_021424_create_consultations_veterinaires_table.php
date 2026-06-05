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
              Schema::create('consultations_veterinaires', function (Blueprint $table) {

    $table->id();

    $table->foreignId('chien_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->date('date_consultation');

    $table->string('veterinaire');

    $table->text('diagnostic');

    $table->text('prescription')
          ->nullable();

    $table->decimal('cout',12,2)
          ->default(0);

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
        Schema::dropIfExists('consultations_veterinaires');
    }
};
