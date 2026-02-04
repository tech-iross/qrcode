<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Colaborador;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed usuário admin
        User::query()->updateOrCreate(
            ['email' => 'admin@admin.com'],
            ['name' => 'Administrador', 'password' => Hash::make('admin123')]
        );

        // Seeds de categorias
        $catParaf = \App\Models\CategoriaProduto::query()->updateOrCreate(['nome' => 'Parafusadeiras Manual']);
        $catAuto = \App\Models\CategoriaProduto::query()->updateOrCreate(['nome' => 'Parafusadeiras Automáticas']);

        // Seeds de perguntas para Parafusadeiras Manual
        $pergunta1 = $catParaf->perguntas()->updateOrCreate(
            ['texto' => 'A ferramenta apresenta ruídos anormais?'],
            ['tipo' => 'multipla_escolha']
        );
        $pergunta1->opcoes()->updateOrCreate(['texto' => 'Sim']);
        $pergunta1->opcoes()->updateOrCreate(['texto' => 'Não']);

        $catParaf->perguntas()->updateOrCreate(
            ['texto' => 'Descreva o estado físico da ferramenta.'],
            ['tipo' => 'texto']
        );

        // Seeds de colaboradores
        Colaborador::query()->upsert([
            ['matricula' => 'C001', 'nome' => 'João Silva', 'funcao' => 'Auxiliar de Produção'],
            ['matricula' => 'C002', 'nome' => 'Maria Oliveira', 'funcao' => 'Operador de Linha'],
            ['matricula' => 'C003', 'nome' => 'Pedro Santos', 'funcao' => 'Técnico de Manutenção'],
        ], ['matricula'], ['nome','funcao']);

        // Seeds de parafusadeiras (produtos)
        Produto::query()->upsert([
            ['codigo' => 'PFD-001','numero_sequencial' => '001','posto' => 'Posto A','linha' => 'Linha 1','setor' => 'Montagem', 'categoria_id' => $catParaf->id],
            ['codigo' => 'PFD-002','numero_sequencial' => '002','posto' => 'Posto B','linha' => 'Linha 1','setor' => 'Montagem', 'categoria_id' => $catParaf->id],
            ['codigo' => 'PFD-003','numero_sequencial' => '003','posto' => 'Posto C','linha' => 'Linha 2','setor' => 'Montagem', 'categoria_id' => $catAuto->id],
            ['codigo' => 'PFD-004','numero_sequencial' => '004','posto' => 'Posto D','linha' => 'Linha 2','setor' => 'Qualidade', 'categoria_id' => $catParaf->id],
            ['codigo' => 'PFD-005','numero_sequencial' => '005','posto' => 'Posto E','linha' => 'Linha 3','setor' => 'Montagem', 'categoria_id' => $catAuto->id],
        ], ['codigo'], ['numero_sequencial','posto','linha','setor', 'categoria_id']);
    }
}
