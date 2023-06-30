<?php

namespace App\Http\Livewire\Supplier;

use App\Models\Person;
use Livewire\Component;
use Livewire\WithPagination;

class ListSuppliers extends Component
{
    public $teste;

    //use WithPagination;

    //protected $paginationTheme = 'bootstrap';

   /*  public array $headers = [
        'Razão Social/Nome',
        'Nome Fantasia/Apelido',
        'CNPJ/CPF',
        'Ativo',
    ];

    public array $columns = [
        'company_name',
        'trading_name',
        'cnpj',
        'is_active',
    ]; */

    /* public $search = ''; */

    /* public function updatingSearch()
    {
        $this->resetPage();
    } */

    public function funcao()
    {
        dd('testee');
    }

    public function render()
    {
        return view('livewire.supplier.list-suppliers');//, ['suppliers' => Person::paginate(10)]);
    }
}
