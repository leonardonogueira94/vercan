@extends('adminlte::page')

@section('content')
<div>
    @livewire('card-person-data')
    @livewire('card-default-contact')
    @livewire('card-additional-contact')
    @livewire('card-address')
    @livewire('card-observation')
</div>
@endsection