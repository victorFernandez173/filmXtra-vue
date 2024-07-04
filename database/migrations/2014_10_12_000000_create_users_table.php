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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 53)->nullable(false);
            $table->string('username', 33)->nullable();
            $table->date('age')->nullable();
            $table->string('country', 73)->nullable();
            $table->string('email', 73);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 253)->nullable();
            $table->string('social_id')->unique()->nullable();
            $table->string('login_tipo_id')->default(\App\Models\LoginTipo::FILMXTRA_TIPO);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

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
        Schema::dropIfExists('users');
    }
};
