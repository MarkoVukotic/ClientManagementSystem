@extends('layouts.app')
@section('title', 'Clients')
@section('content')
    <h1>Show more information about the client</h1>
    @include('client.components.displayClientInformation')
@endsection
