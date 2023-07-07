<?php

use App\Http\Livewire\Person\CreatePerson;
use App\Http\Livewire\Person\DeletePerson;
use App\Http\Livewire\Person\EditPerson;
use App\Http\Livewire\Person\ListPeople;
use App\Http\Livewire\Person\ShowPerson;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Supplier
|--------------------------------------------------------------------------
|
| Registrar rotas relacionadas ao módulo de Fornecedores aqui.
|
*/

Route::middleware(['auth', 'web'])->prefix('fornecedor')->group(function () {
    Route::get('/listar', ListPeople::class)->name('person.list');
    Route::get('/cadastrar', CreatePerson::class)->name('person.create');
    Route::get('/{person}/ver', ShowPerson::class)->name('person.show');
    Route::get('/{person}/editar', EditPerson::class)->name('person.edit');
    Route::delete('/{person}/deletar', DeletePerson::class)->name('person.delete');
});