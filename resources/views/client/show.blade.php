@extends('layouts.app')
@section('title', 'Clients')
@section('content')
    <h1>Create Client Page</h1>
    @include('client.components.createClientForm')
@endsection
