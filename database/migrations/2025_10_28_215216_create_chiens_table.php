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
        Schema::create('chiens', function (Blueprint $table) {
            $table->id();
             $table->string('reference',50)->unique();
            $table->string('nom',100)->nullable();
            $table->foreignId('race_id')->constrained('races')->cascadeOnDelete();
            $table->foreignId('partenaire_id')->nullable()->constrained('partenaires')->nullOnDelete();
            $table->decimal('prix_base',12,2)->default(0);
            $table->decimal('prix_vaccine',12,2)->nullable();
            $table->decimal('prix_dressage',12,2)->nullable();
            $table->boolean('vacciné')->default(false);
            $table->boolean('dresse')->default(false);
            $table->enum('statut',['disponible','reserve','vendu','en_soins'])->default('disponible');
            $table->enum('provenance',['cursage','partenaire'])->default('cursage');
            $table->string('photo')->nullable();
            $table->date('date_arrive')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chiens');
    }
};
