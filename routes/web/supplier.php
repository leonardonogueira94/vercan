<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Supplier\CreateSupplier;
use App\Http\Livewire\Supplier\DeleteSupplier;
use App\Http\Livewire\Supplier\EditSupplier;
use App\Http\Livewire\Supplier\ListSuppliers;
use App\Http\Livewire\Supplier\ShowSupplier;

/*
|--------------------------------------------------------------------------
| Web Routes - Supplier
|--------------------------------------------------------------------------
|
| Registrar rotas relacionadas ao módulo de Fornecedores aqui.
|
*/

Route::prefix('fornecedor')->group(function () {
    Route::get('/listar', ListSuppliers::class)->name('supplier.list');
    Route::get('/cadastrar', CreateSupplier::class)->name('supplier.create');
    Route::get('/{person}/ver', ShowSupplier::class)->name('supplier.show');
    Route::get('/{person}/editar', EditSupplier::class)->name('supplier.edit');
    Route::delete('/{person}/deletar', DeleteSupplier::class)->name('supplier.delete');
});