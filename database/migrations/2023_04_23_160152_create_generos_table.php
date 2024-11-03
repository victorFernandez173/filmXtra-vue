<?php

use App\Models\Genero;
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
        Schema::create('generos', function (Blueprint $table) {
            $table->id();
            $table->string('genero_es', 255)->nullable(false);
            $table->string('genero_en', 255)->nullable(false);
            $table->timestamp(Genero::CREATED_AT)->useCurrent();
            $table->timestamp(Genero::UPDATED_AT)->useCurrent();

            $table->unique('genero_es');
            $table->unique('genero_en');

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
        Schema::dropIfExists('generos');
    }
};
