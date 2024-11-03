<?php

use App\Models\Pais;
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
        Schema::create('paises', function (Blueprint $table) {
            $table->string('id', 2)->primary();
            $table->string('pais_es', 255)->nullable(false);
            $table->string('pais_en', 255)->nullable(false);
            $table->timestamp(Pais::CREATED_AT)->useCurrent();
            $table->timestamp(Pais::UPDATED_AT)->useCurrent();

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
        Schema::dropIfExists('paises');
    }
};
