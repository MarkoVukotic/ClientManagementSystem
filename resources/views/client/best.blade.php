@extends('layouts.app')
@section('title', 'Clients')
@section('content')
    <h1>Best Client Page</h1>
    @include('client.components.bestClientTable')
@endsection
