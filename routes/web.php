<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/flow/');
});

// Rotas públicas - Login
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

// Fluxo de leitura e etapas (PÚBLICO)
Route::prefix('flow')->name('flow.')->group(function () {
    Route::get('/', [\App\Http\Controllers\CheckPointFlowController::class, 'index'])->name('index');
    Route::post('/reset', [\App\Http\Controllers\CheckPointFlowController::class, 'reset'])->name('reset');

    Route::get('/scan-colaborador', [\App\Http\Controllers\CheckPointFlowController::class, 'scanColaborador'])->name('scan.colaborador');
    Route::post('/process-colaborador', [\App\Http\Controllers\CheckPointFlowController::class, 'processColaborador'])->name('process.colaborador');

    Route::get('/scan-produto', [\App\Http\Controllers\CheckPointFlowController::class, 'scanProduto'])->name('scan.produto');
    Route::post('/process-produto', [\App\Http\Controllers\CheckPointFlowController::class, 'processProduto'])->name('process.produto');

    Route::get('/checkpoint', [\App\Http\Controllers\CheckPointFlowController::class, 'checkpoint'])->name('checkpoint');
    Route::post('/checkpoint', [\App\Http\Controllers\CheckPointFlowController::class, 'storeCheckpoint'])->name('checkpoint.store');
});

// Rotas protegidas - requer autenticação
Route::middleware('auth')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    // CRUD Categorias
    Route::resource('categorias', \App\Http\Controllers\Admin\CategoriaController::class)->names('admin.categorias');

    // CRUD Colaboradores
    Route::resource('colaboradores', \App\Http\Controllers\ColaboradorController::class)
    ->parameters(['colaboradores' => 'colaborador'])
    ->except(['show']);
    Route::get('/colaboradores/{colaborador}/qrcode', [\App\Http\Controllers\ColaboradorController::class, 'qrcode'])->name('colaboradores.qrcode');

    // CRUD Produtos
    Route::resource('produtos', \App\Http\Controllers\ProdutoController::class)->except(['show']);
    Route::get('/produtos/{produto}/qrcode', [\App\Http\Controllers\ProdutoController::class, 'qrcode'])->name('produtos.qrcode');

    // CRUD Perguntas (associadas a produto)
    Route::get('/produtos/{produto}/perguntas', [\App\Http\Controllers\Admin\PerguntaController::class, 'index'])->name('admin.perguntas.index');
    Route::get('/produtos/{produto}/perguntas/create', [\App\Http\Controllers\Admin\PerguntaController::class, 'create'])->name('admin.perguntas.create');
    Route::post('/produtos/{produto}/perguntas', [\App\Http\Controllers\Admin\PerguntaController::class, 'store'])->name('admin.perguntas.store');
    Route::delete('/perguntas/{pergunta}', [\App\Http\Controllers\Admin\PerguntaController::class, 'destroy'])->name('admin.perguntas.destroy');

    // Relatórios de CheckPoints
    Route::get('checkpoints', [\App\Http\Controllers\Admin\CheckPointController::class, 'index'])->name('admin.checkpoints.index');
    Route::get('checkpoints/{checkpoint}', [\App\Http\Controllers\Admin\CheckPointController::class, 'show'])->name('admin.checkpoints.show');
    Route::get('checkpoints/{checkpoint}/pdf', [\App\Http\Controllers\Admin\CheckPointController::class, 'pdf'])->name('admin.checkpoints.pdf');

    // CRUD Usuários
    Route::resource('users', \App\Http\Controllers\UserController::class)->except(['show']);
});
