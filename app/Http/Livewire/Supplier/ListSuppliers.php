<?php

namespace App\Http\Livewire\Supplier;

use App\Models\Person;
use Livewire\Component;
use Livewire\WithPagination;

class ListSuppliers extends Component
{
    public $teste;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public array $headers = ['Razão Social/Nome', 'Nome Fantasia/Apelido', 'CNPJ/CPF', 'Ativo'];

    public array $columns = ['company_name' => 'name','trading_name' => 'alias','cnpj' => 'cpf', 'is_active'];

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.supplier.list-suppliers', ['people' => Person::paginate(10)]);
    }
}
