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
            Schema::create('naissances', function (Blueprint $table) {

    $table->id();

    $table->foreignId('reproduction_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->date('date_naissance');

    $table->integer('nombre_males')
          ->default(0);

    $table->integer('nombre_femelles')
          ->default(0);

    $table->integer('nombre_morts')
          ->default(0);

    $table->text('observation')
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
        Schema::dropIfExists('naissances');
    }
};
