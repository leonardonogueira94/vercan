<div>
    <x-card.headless-card>
        <div class="row datatable-header">
            <div class="col-md-6 d-flex justify-content-start">
                Mostrando 
                <x-datatable.per-page/>
                 Resultados
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
                            @foreach($headers as $header)
                                <td>{{ $header }}</td>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rows as $row)
                            <tr wire:key="row-{{ $row->id }}">
                                @foreach($columns as $column)
                                    <td>{{ $row->$column }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
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