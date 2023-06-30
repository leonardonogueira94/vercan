@section('content')
<div>
    {{-- <x-datatable.datatable :headers="$headers" :columns="$columns" :rows="$suppliers"/> --}}
    {{ $teste }}
    <input wire:model="teste" type="text">
    <button wire:click="funcao">TESTE</button>
</div>
@endsection