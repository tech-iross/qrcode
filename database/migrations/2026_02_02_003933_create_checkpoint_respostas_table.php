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
        Schema::create('checkpoint_respostas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checkpoint_id')->constrained('checkpoints')->cascadeOnDelete();
            $table->foreignId('pergunta_id')->constrained('perguntas')->cascadeOnDelete();
            $table->text('resposta_texto')->nullable();
            $table->foreignId('opcao_selecionada_id')->nullable()->constrained('opcoes_perguntas')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkpoint_respostas');
    }
};
