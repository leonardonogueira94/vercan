@inject('maskService', 'App\Services\MaskService')
<div>
    <x-card.headless-card>
        <div class="row datatable-header">
            <div class="col-md-6 d-flex justify-content-start">
                Mostrando 
                <x-datatable.per-page value="{{ $perPage }}"/>
                resultados
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                Filtro: <input wire:model="filter" type="text" class="form-control form-control-sm filter">
            </div>
        </div>
        <div class="row datatable-body">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Razão Social/Nome</th>
                                <th>Nome Fantasia/Apelido</th>
                                <th>CNPJ/CPF</th>
                                <th>Ativo</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $person)
                                <tr wire:key="row-{{ $person->id }}">
                                    <td>{{ $person->company_name ?? $person->name }}</td>
                                    <td>{{ $person->trading_name ?? $person->alias }}</td>
                                    <td>{{ $person->cnpj ?? $person->cpf }}</td>
                                    <td>{{ App\Enums\Person\PersonStatus::tryFrom($person->is_active)->label() }}</td>
                                    <td>
                                        <x-datatable.actions-button 
                                            showRoute="{{ route('person.show', ['person' => $person->id]) }}" 
                                            editRoute="{{ route('person.edit', ['person' => $person->id]) }}" 
                                            deleteRoute="{{ route('person.delete', ['person' => $person->id]) }}"
                                        />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Razão Social/Nome</th>
                                <th>Nome Fantasia/Apelido</th>
                                <th>CNPJ/CPF</th>
                                <th>Ativo</th>
                                <th>Ação</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
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