<?php

use App\Models\Obra;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migrar.
     */
    public function up(): void
    {
        Schema::create('obras', function (Blueprint $table) {
            $table->id();
            $table->string('titulo_es', 200)->nullable(false)->unique();
            $table->string('titulo_en', 200)->nullable(false)->unique();
            $table->string('titulo_slug', 200)->nullable(false)->unique();
            $table->string('titulo_original', 200)->nullable(false);
            $table->string('pais_id', 2);
            $table->foreign('pais_id')->references('id')->on('paises');
            $table->decimal('duracion', 3, 0)->nullable(false);
            $table->string('sinopsis_es', 2500)->nullable(false);
            $table->string('sinopsis_en', 2500)->nullable(false);
            $table->year('fecha')->nullable(false);
            $table->string('productora', 255)->nullable(false)->default('-');

            $table->timestamp(Obra::CREATED_AT)->useCurrent();
            $table->timestamp(Obra::UPDATED_AT)->useCurrent();

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Anular migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('obras');
    }
};
