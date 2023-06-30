@section('content')
<div>
    <x-datatable.datatable :headers="$headers" :columns="$columns" :rows="$suppliers"/>
</div>
@endsection