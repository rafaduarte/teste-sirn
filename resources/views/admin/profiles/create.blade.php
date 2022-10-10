@include('admin.includes.alerts')

@extends('adminlte::page')

@section('title', 'Cadastrar Novo Perfil')

@section('content_header')
    <h1>Cadastrar Novo Setor</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profiles.store') }}" class="form" method="POST">
                @include('admin.profiles._partials.form')
            </form>
        </div>
    </div>
@endsection
