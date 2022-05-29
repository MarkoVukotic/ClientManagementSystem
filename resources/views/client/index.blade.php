@extends('layouts.app')
@section('title', 'Clients')
@section('content')
    <h1 style="text-align: center; margin-bottom: 1em">Clients page</h1>
    @include('client.components.table')
@endsection
