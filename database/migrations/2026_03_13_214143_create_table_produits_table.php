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
        Schema::create('produits', function (Blueprint $table) {

$table->id();

$table->string('nom');

$table->text('description')->nullable();

$table->foreignId('categorie_id')
      ->constrained('categories');

$table->decimal('prix_achat',10,2)->default(0);

$table->decimal('prix_vente',10,2)->default(0);

$table->integer('stock')->default(0);

$table->string('unite')->default('piece');

$table->string('photo')->nullable();

$table->timestamps();

});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produits', function (Blueprint $table) {
            //
        });
    }
};
