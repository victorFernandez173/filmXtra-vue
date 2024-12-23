<?php

use App\Models\Evaluacion;
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
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obra_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('usuario_id')->constrained()->onDelete('CASCADE');
            $table->decimal('evaluacion', 3, 1)->nullable(false);

            $table->timestamp(Evaluacion::CREATED_AT)->useCurrent();
            $table->timestamp(Evaluacion::UPDATED_AT)->useCurrent();

            $table->unique(['obra_id', 'usuario_id']);

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
        Schema::dropIfExists('evaluaciones');
    }
};
