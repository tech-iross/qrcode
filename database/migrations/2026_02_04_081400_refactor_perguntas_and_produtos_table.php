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
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('torque_padrao');
        });

        Schema::table('perguntas', function (Blueprint $table) {
            $table->dropForeign(['produto_id']);
            $table->dropColumn('produto_id');
            $table->foreignId('categoria_id')->after('id')->constrained('categorias_produtos')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perguntas', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
            $table->dropColumn('categoria_id');
            $table->foreignId('produto_id')->after('id')->constrained('produtos')->cascadeOnDelete();
        });

        Schema::table('produtos', function (Blueprint $table) {
            $table->string('torque_padrao')->nullable();
        });
    }
};
