<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('setups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('colaborador_id')->constrained('colaboradores')->cascadeOnDelete();
            $table->foreignId('produto_id')->nullable()->constrained('produtos')->nullOnDelete();
            $table->string('codigo_colaborador'); // código lido do QR
            $table->string('codigo_produto'); // código lido do QR
            $table->timestamp('started_at')->nullable();
            $table->timestamp('etapa1_at')->nullable();
            $table->timestamp('etapa2_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->decimal('torque_informado', 8, 2)->nullable();
            $table->timestamps();
            $table->index(['colaborador_id', 'produto_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('setups');
    }
};
