<?php

use App\Http\Livewire\Supplier\CreateSupplier;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Supplier\ListSuppliers;

/*
|--------------------------------------------------------------------------
| Web Routes - Supplier
|--------------------------------------------------------------------------
|
| Registre rotas relacionadas ao módulo de Fornecedores aqui.
|
*/

Route::get('/atendimentos', 'AtendimentoController@index')->name('atendimentos.lista');

Route::prefix('fornecedor')->group(function () {
    Route::get('/', ListSuppliers::class)->name('supplier.list');
    Route::get('/cadastrar', CreateSupplier::class)->name('supplier.create');
});