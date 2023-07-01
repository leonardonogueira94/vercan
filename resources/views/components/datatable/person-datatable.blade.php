<div>
    <x-card.headless-card>
        <div class="row datatable-header">
            <div class="col-md-6 d-flex justify-content-start">
                Mostrando 
                <x-datatable.per-page value="{{ $perPage }}"/>
                resultados
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                    Filtro: <input type="text" class="form-control form-control-sm filter">
            </div>
        </div>
        <div class="row datatable-body">
            <div class="col-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td>Razão Social/Nome</td>
                            <td>Nome Fantasia/Apelido</td>
                            <td>CNPJ/CPF</td>
                            <td>Ativo</td>
                            <td>Ação</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rows as $person)
                            <tr wire:key="row-{{ $person->id }}">
                                <td>{{ $person->personable->company_name ?? $person->personable->name }}</td>
                                <td>{{ $person->personable->trading_name ?? $person->personable->alias }}</td>
                                <td>{{ $person->personable->cnpj ?? $person->personable->cpf }}</td>
                                <td>{{ $person->is_active }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Razão Social/Nome</td>
                            <td>Nome Fantasia/Apelido</td>
                            <td>CNPJ/CPF</td>
                            <td>Ativo</td>
                            <td>Ação</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row datatable-footer">
            <div class="col-12">
                <div class="d-flex justify-content-end">
                    {{ $rows->links() }}
                </div>
            </div>
        </div>
    </x-card.headless-card>
</div>