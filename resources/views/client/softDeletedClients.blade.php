@extends('layouts.app')
@section('title', 'Clients')
@section('content')
    <h1>Deleted Clients</h1>
    @include('client.components.softDeletedClientsTable')
@endsection
