@section('header')
    Fornecedores
@endsection
<div>
    <x-alerts/>
    <div class="row">
        <div class='col-md-12'>
            <a href="{{ route('person.create') }}" class="btn-cadastrar btn btn-success float-right"><i class="fa fa-plus"></i> Cadastrar</a>
        </div>
    </div>
    <x-datatable.person-datatable :rows="$people" perPage="{{ $perPage }}"/>
</div>