<?php

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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('usuario', 53)->nullable(false);
            $table->string('nombre', 53)->nullable();
            $table->string('apellidos', 106)->nullable();
            $table->date('age')->nullable();
            $table->string('pais', 73)->nullable();
            $table->string('email', 73);
            $table->timestamp('email_verificado_fecha')->nullable();
            $table->string('password', 253)->nullable();
            $table->string('social_id')->unique()->nullable();
            $table->string('login_tipo_id')->default(\App\Models\LoginTipo::FILMXTRA_TIPO);
            $table->timestamp('creado')->useCurrent();
            $table->timestamp('modificado')->useCurrent();

            $table->unique(['email', 'login_tipo_id']);

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
        Schema::dropIfExists('usuarios');
    }
};
