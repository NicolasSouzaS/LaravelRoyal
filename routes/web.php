<?php

use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\BarbeiroController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CadastrarController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\CortesController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\GerenteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SobreController;
use App\Models\Cadastrar;
use Faker\Guesser\Name;
use Illuminate\Auth\Events\Login;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/sobre', [SobreController::class, 'index'])->name('sobre');


//CORTES
Route::get('/cortes', [CortesController::class, 'index'])->name('cortes');
Route::get('/servicos/barba', [CortesController::class, 'barba'])->name('barba');
Route::get('/servicos/coloracao', [CortesController::class, 'coloracao'])->name('coloracao');
Route::get('/servicos/cuidados', [CortesController::class, 'cuidados'])->name('cuidados');
Route::get('/servicos/tratamento', [CortesController::class, 'tratamento'])->name('tratamento');


// CONTATO
Route::get('/contato', [ContatoController::class, 'index'])->name('contato');
// Route::get('/contato/enviar', [ContatoController::class, 'salvarNoBanco'])->name('contato.enviar');
// Route::get('/contato/enviarnew', [ContatoController::class, 'salvarEmail'])->name('contato.enviarnew');

// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class, 'autenticar'])->name('login');

Route::get('/cadastrar', [CadastrarController::class, 'index'])->name('cadastrar');
Route::post('/cadastrar', [CadastrarController::class, 'cadastrar'])->name('cadastrar');


// AUTENTICAÇÃO DE GERENTE
Route::middleware(['autenticacao:gerente'])->group(function() {
    Route::get('/dashboard/gerente', [GerenteController::class, 'index'])->name('gerente');
});

// AUTENTICAÇÃO DE BARBEIRO (FUNCIONÁRIO COMUM)
Route::middleware(['autenticacao:barbeiro'])->group(function () {
    Route::get('/dashboard/barbeiro', [BarbeiroController::class, 'index'])->name('barbeiro');
    Route::get('/dashboard/barbeiro', [BarbeiroController::class, 'clientesMensais'])->name('barbeiro');
    Route::get('/dashboard/barbeiro/perfil', [BarbeiroController::class, 'perfil'])->name('barbeiro.perfil');
    Route::put('dashboard/barbeiro/perfil/{id}',[BarbeiroController::class, 'update'])->name('barbeiro.update');
    Route::get('dashboard/barbeiro/perfil/{id}edit',[BarbeiroController::class, 'edit'])->name('barbeiro.edit');
    Route::get('/dashboard/barbeiro/compromisso', [BarbeiroController::class, 'compromisso'])->name('barbeiro.compromisso');
});

// AUTENTICAÇÃO DE CLIENTE
Route::middleware(['autenticacao:cliente'])->group(function () {
    Route::get('/dashboard/cliente', [ClienteController::class, 'index'])->name('cliente');
    Route::get('/dashboard/cliente/compromissos', [ClienteController::class, 'compromissos'])->name('compromissos');
    Route::get('/dashboard/cliente/agendamento',[AgendamentoController::class, 'index'])->name('agendar');
    Route::get('/dashboard/cliente/agendamento/calendario',[AgendamentoController::class, 'calendario'])->name('pagina.calendario');

});

Route::get('/sair', function() {
    session()->flush();
    return redirect('/');
})->name('sair');


Route::get('/dashboard/cliente/obterFuncionariosDisponiveis', [AgendamentoController::class, 'obterFuncionariosDisponiveis'])->name('funcs');
Route::get('/funcs3', [AgendamentoController::class, 'calendario'])->name('funcs2');
Route::get('/consultaH', [AgendamentoController::class, 'consultarHorarios'])->name('consultaH');

Route::post('/agendamentos', 'App\Http\Controllers\AgendamentoController@store')->name('agendamentos.store');
