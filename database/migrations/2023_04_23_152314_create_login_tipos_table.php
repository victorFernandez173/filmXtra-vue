<?php

use App\Models\LoginTipo;
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
        Schema::create('login_tipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 120)->nullable(false);

            $table->timestamp(LoginTipo::CREATED_AT)->useCurrent();
            $table->timestamp(LoginTipo::UPDATED_AT)->useCurrent();

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
        Schema::dropIfExists('login_tipos');
    }
};
