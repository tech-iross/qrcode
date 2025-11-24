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
    Route::get('/', [\App\Http\Controllers\SetupFlowController::class, 'index'])->name('index');
    Route::post('/reset', [\App\Http\Controllers\SetupFlowController::class, 'reset'])->name('reset');

    Route::get('/scan-colaborador', [\App\Http\Controllers\SetupFlowController::class, 'scanColaborador'])->name('scan.colaborador');
    Route::post('/process-colaborador', [\App\Http\Controllers\SetupFlowController::class, 'processColaborador'])->name('process.colaborador');

    Route::get('/scan-produto', [\App\Http\Controllers\SetupFlowController::class, 'scanProduto'])->name('scan.produto');
    Route::post('/process-produto', [\App\Http\Controllers\SetupFlowController::class, 'processProduto'])->name('process.produto');

    Route::post('/concluir', [\App\Http\Controllers\SetupFlowController::class, 'concluir'])->name('concluir');
});

// Rotas protegidas - requer autenticação
Route::middleware('auth')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    // CRUD Colaboradores
    Route::resource('colaboradores', \App\Http\Controllers\ColaboradorController::class)
    ->parameters(['colaboradores' => 'colaborador'])
    ->except(['show']);
    Route::get('/colaboradores/{colaborador}/qrcode', [\App\Http\Controllers\ColaboradorController::class, 'qrcode'])->name('colaboradores.qrcode');

    // CRUD Produtos
    Route::resource('produtos', \App\Http\Controllers\ProdutoController::class)->except(['show']);
    Route::get('/produtos/{produto}/qrcode', [\App\Http\Controllers\ProdutoController::class, 'qrcode'])->name('produtos.qrcode');

    // Listagem de setups
    Route::get('setups', [\App\Http\Controllers\SetupController::class, 'index'])->name('setups.index');

    // CRUD Usuários
    Route::resource('users', \App\Http\Controllers\UserController::class)->except(['show']);
});
